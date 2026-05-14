(function () {
  var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  /** Волна в .section-head (chip / h2 / lead) + .reveal-from-bottom на контенте */
  function initRevealSections() {
    function drainToFragment(el) {
      var frag = document.createDocumentFragment();
      while (el.firstChild) frag.appendChild(el.firstChild);
      return frag;
    }

    function makeWaveLine(frag) {
      var line = document.createElement("span");
      line.className = "section-wave-line";
      var inner = document.createElement("span");
      inner.className = "section-wave-line__inner";
      inner.appendChild(frag);
      line.appendChild(inner);
      return line;
    }

    function firstChildMatch(el, selector) {
      var c = el.children;
      for (var i = 0; i < c.length; i++) {
        if (c[i].matches(selector)) return c[i];
      }
      return null;
    }

    function wrapChip(chip) {
      if (!chip || chip.querySelector(".section-wave-line")) return;
      var frag = drainToFragment(chip);
      var w = makeWaveLine(frag);
      w.classList.add("section-wave-line--chip");
      chip.appendChild(w);
    }

    function splitH2ToWaves(h2) {
      if (!h2 || !h2.classList.contains("display-sm") || h2.getAttribute("data-section-wave-split") === "1") return;
      var nodes = Array.prototype.slice.call(h2.childNodes);
      var out = document.createDocumentFragment();
      var buf = document.createDocumentFragment();
      function flush() {
        if (!buf.childNodes.length) return;
        var mv = document.createDocumentFragment();
        while (buf.firstChild) mv.appendChild(buf.firstChild);
        out.appendChild(makeWaveLine(mv));
      }
      nodes.forEach(function (node) {
        if (node.nodeType === Node.TEXT_NODE && node.nodeValue) {
          buf.appendChild(document.createTextNode(node.nodeValue));
        } else if (node.nodeType === Node.ELEMENT_NODE && node.tagName === "BR") {
          flush();
          out.appendChild(node.cloneNode(true));
        } else if (node.nodeType === Node.ELEMENT_NODE) {
          buf.appendChild(node.cloneNode(true));
        }
      });
      flush();
      h2.textContent = "";
      while (out.firstChild) h2.appendChild(out.firstChild);
      h2.setAttribute("data-section-wave-split", "1");
    }

    function wrapLead(leadp) {
      if (
        !leadp ||
        !leadp.classList.contains("lead") ||
        leadp.querySelector(".section-wave-line")
      )
        return;
      var frag = drainToFragment(leadp);
      leadp.appendChild(makeWaveLine(frag));
    }

    function enhanceSectionHead(head) {
      var chipEl = firstChildMatch(head, ".chip") || head.querySelector(".chip");
      wrapChip(chipEl);
      splitH2ToWaves(firstChildMatch(head, "h2.display-sm") || head.querySelector("h2.display-sm"));
      wrapLead(firstChildMatch(head, "p.lead") || head.querySelector("p.lead"));
    }

    function stampWaveChain(sectionRoot) {
      sectionRoot.querySelectorAll(".section-wave-line").forEach(function (line, idx) {
        var s = String(idx);
        line.style.setProperty("--wave-i", s);
        var inner = line.querySelector(".section-wave-line__inner");
        if (inner) inner.style.setProperty("--wave-i", s);
      });
      var n = Math.max(1, sectionRoot.querySelectorAll(".section-wave-line").length);
      var riseAfter = (0.04 + Math.min(n, 12) * 0.058).toFixed(3);
      sectionRoot.style.setProperty("--rise-base-delay", riseAfter + "s");
    }

    function stampRise(sectionRoot) {
      if (!sectionRoot) return;
      var i = 0;
      function addSel(sel) {
        sectionRoot.querySelectorAll(sel).forEach(function (el) {
          el.classList.add("reveal-from-bottom");
          el.style.setProperty("--rise-idx", String(i++));
        });
      }

      if (sectionRoot.classList.contains("footer-card")) {
        addSel(".contact-form");
        addSel(".contact-block");
        return;
      }

      var sid = sectionRoot.id;
      switch (sid) {
        case "services":
          addSel(".services-grid .service-card");
          break;
        case "projects":
          addSel(".project-card");
          break;
        case "projects-catalog":
          addSel(".catalog-card");
          addSel(".projects-toolbar");
          break;
        case "testimonials":
          addSel(".clients-row");
          addSel(".testimonial-shell");
          break;
        case "process":
          /* .tl-row: отдельный initProcessTimeline() — по скроллу в обе стороны */
          break;
        case "pricing":
          addSel(".pricing-toggle");
          addSel(".pricing-card");
          break;
        case "toolkit":
          addSel(":scope > .tool-row");
          break;
        case "newsletter":
          addSel(".news-inner > .news-form");
          addSel(".news-inner > .marquee");
          break;
        case "faq":
          addSel(".faq-item");
          addSel(".faq-cta");
          break;
        default:
          break;
      }
    }

    var roots = [];
    document.querySelectorAll("main section.section.reveal").forEach(function (n) {
      roots.push(n);
    });
    var fc = document.querySelector("footer .footer-card.reveal");
    if (fc) roots.push(fc);

    roots.forEach(function (sec) {
      sec.querySelectorAll(".section-head").forEach(function (hd) {
        enhanceSectionHead(hd);
      });
      stampWaveChain(sec);
      stampRise(sec);
    });
  }

  if (!reduceMotion) {
    initRevealSections();
  }

  /*
   * Таймлайн: первая точка у начала линии (.tl-origin), шаги — по одной линии триггера.
   * Вниз: 1 → 2 → 3; вверх гаснут в обратном порядке (нижний якорь пересекает триггер первым).
   */
  function initProcessTimeline() {
    if (reduceMotion) return;
    var timeline = document.querySelector("#process .timeline");
    if (!timeline) return;
    var origin = timeline.querySelector(".tl-origin");
    var rows = timeline.querySelectorAll(".tl-row");
    if (!rows.length) return;

    var ticking = false;
    function updateProcessTimeline() {
      var h = window.innerHeight || 1;
      var trigger = h * 0.52;
      var originTrigger = h * 0.62;
      var tRect = timeline.getBoundingClientRect();
      var inView = tRect.bottom > 0 && tRect.top < h;

      if (origin) {
        origin.classList.toggle("tl-visible", inView && tRect.top < originTrigger);
      }
      rows.forEach(function (row) {
        var r = row.getBoundingClientRect();
        var anchor = r.top + Math.min(Math.max(r.height * 0.28, 24), 72);
        row.classList.toggle("tl-visible", inView && anchor < trigger);
      });
      ticking = false;
    }

    function requestTick() {
      if (!ticking) {
        ticking = true;
        if (typeof requestAnimationFrame === "function") {
          requestAnimationFrame(updateProcessTimeline);
        } else {
          setTimeout(updateProcessTimeline, 0);
        }
      }
    }

    window.addEventListener("scroll", requestTick, { passive: true });
    window.addEventListener("resize", requestTick);
    updateProcessTimeline();
  }
  initProcessTimeline();

  /* FAQ: снять reveal-from-bottom после section-content-rise — иначе animation fill-mode
   * держит transform сильнее transition, hover резкий (и !important ломает плавность). */
  if (!reduceMotion) {
    document.querySelectorAll("#faq .faq-item.reveal-from-bottom").forEach(function (item) {
      item.addEventListener("animationend", function (ev) {
        if (ev.animationName !== "section-content-rise" || ev.target !== item) return;
        item.classList.remove("reveal-from-bottom");
      });
    });
  }

  /* scroll reveal */
  var reveals = document.querySelectorAll(".reveal:not(.hero-intro)");
  if (reveals.length && "IntersectionObserver" in window) {
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            e.target.classList.add("is-visible");
            io.unobserve(e.target);
          }
        });
      },
      { rootMargin: "0px 0px -8% 0px", threshold: 0.08 }
    );
    reveals.forEach(function (el) {
      io.observe(el);
    });
  } else {
    reveals.forEach(function (el) {
      el.classList.add("is-visible");
    });
  }

  /* Hero intro choreography (header -> pill -> title lines -> sub -> cta -> carousel) */
  var heroIntro = document.querySelector(".hero-intro");
  if (heroIntro) {
    var body = document.body;

    if (!reduceMotion) {
      body.classList.add("intro-pending");
      requestAnimationFrame(function () {
        requestAnimationFrame(function () {
          body.classList.add("intro-run");
          body.classList.remove("intro-pending");
          setTimeout(function () {
            body.classList.remove("intro-run");
            body.classList.add("intro-done");
          }, 3200);
        });
      });
    } else {
      body.classList.add("intro-done");
    }
  }

  /* FAQ */
  document.querySelectorAll("[data-faq]").forEach(function (item) {
    var btn = item.querySelector(".faq-q");
    btn.addEventListener("click", function () {
      var open = item.classList.contains("is-open");
      document.querySelectorAll("[data-faq].is-open").forEach(function (o) {
        if (o !== item) o.classList.remove("is-open");
      });
      item.classList.toggle("is-open", !open);
    });
  });

  /* Testimonials */
  var track = document.querySelector("[data-t-track]");
  var slides = track ? track.querySelectorAll(".testimonial-slide") : [];
  var ti = 0;
  function tGo(n) {
    if (!track || !slides.length) return;
    ti = (n + slides.length) % slides.length;
    track.style.transform = "translateX(" + -100 * ti + "%)";
  }
  var prev = document.querySelector("[data-t-prev]");
  var next = document.querySelector("[data-t-next]");
  if (prev) prev.addEventListener("click", function () {
    tGo(ti - 1);
  });
  if (next) next.addEventListener("click", function () {
    tGo(ti + 1);
  });

  /* Pricing toggle (copy из PORTFOLIO_I18N — язык с сервера) */
  var pt = document.querySelector("[data-pricing-toggle]");
  var pricingRoot = document.getElementById("pricing");
  var I = typeof window.PORTFOLIO_I18N !== "undefined" ? window.PORTFOLIO_I18N : null;
  var P = I && I.pricing ? I.pricing : null;
  function pricingPointsHtml(plan) {
    if (!P || !plan || !plan.points || !plan.points.length) return "";
    var icon =
      I && I.assets && I.assets.check
        ? I.assets.check
        : "/assets/icons/pricing/check.svg";
    return plan.points
      .map(function (line) {
        return (
          '<div class="point"><img src="' +
          icon +
          '" alt="" />' +
          line +
          "</div>"
        );
      })
      .join("");
  }
  if (pt && pricingRoot && P) {
    var title = pricingRoot.querySelector("[data-p-title]");
    var sub = pricingRoot.querySelector("[data-p-sub]");
    var hi = pricingRoot.querySelector("[data-p-highlight]");
    var price = pricingRoot.querySelector("[data-p-price]");
    var pPoints = pricingRoot.querySelector("[data-p-points]");
    pt.querySelectorAll("button").forEach(function (b) {
      b.addEventListener("click", function () {
        var mobile = b.getAttribute("data-plan") === "mobile";
        pt.classList.toggle("enterprise", mobile);
        var plan = mobile ? P.mobile : P.web;
        if (!plan) return;
        if (title) title.textContent = plan.title || "";
        if (sub) sub.textContent = plan.sub || "";
        if (hi) hi.textContent = plan.highlight || "";
        if (price) price.innerHTML = plan.priceHtml || "";
        if (pPoints) pPoints.innerHTML = pricingPointsHtml(plan);
      });
    });
  }

  /* Hero CTA → pricing */
  var heroBtn = document.querySelector(".hero .btn-primary");
  if (heroBtn) {
    heroBtn.addEventListener("click", function () {
      var el = document.getElementById("pricing");
      if (el) el.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth" });
    });
  }

  /* Projects catalog filters */
  (function initProjectsCatalogFilters() {
    var root = document.querySelector("[data-projects-catalog]");
    var list = document.querySelector("[data-project-list]");
    if (!root || !list) return;

    var search = root.querySelector("[data-project-search]");
    var kindFilters = root.querySelectorAll("[data-project-filter]");
    var statusFilters = root.querySelectorAll("[data-project-status]");
    var kindSelect = root.querySelector("[data-project-filter-select]");
    var statusSelect = root.querySelector("[data-project-status-select]");
    var empty = document.querySelector("[data-project-empty]");
    var cards = Array.prototype.slice.call(list.querySelectorAll("[data-project-kind]"));
    var activeKind = "all";
    var activeStatus = "all";

    function apply() {
      var q = search ? search.value.trim().toLowerCase() : "";
      var visible = 0;
      cards.forEach(function (card) {
        var kind = card.getAttribute("data-project-kind") || "";
        var status = card.getAttribute("data-project-status") || "";
        var text = (card.getAttribute("data-project-text") || "").toLowerCase();
        var byType = activeKind === "all" || kind === activeKind;
        var byStatus = activeStatus === "all" || status === activeStatus;
        var byText = q === "" || text.indexOf(q) !== -1;
        var show = byType && byStatus && byText;
        card.hidden = !show;
        if (show) visible++;
      });
      if (empty) empty.hidden = visible !== 0;
    }

    kindFilters.forEach(function (btn) {
      btn.addEventListener("click", function () {
        activeKind = btn.getAttribute("data-project-filter") || "all";
        kindFilters.forEach(function (b) {
          b.classList.toggle("is-active", b === btn);
        });
        if (kindSelect) kindSelect.value = activeKind;
        apply();
      });
    });

    statusFilters.forEach(function (btn) {
      btn.addEventListener("click", function () {
        activeStatus = btn.getAttribute("data-project-status") || "all";
        statusFilters.forEach(function (b) {
          b.classList.toggle("is-active", b === btn);
        });
        if (statusSelect) statusSelect.value = activeStatus;
        apply();
      });
    });

    if (kindSelect) {
      kindSelect.addEventListener("change", function () {
        activeKind = kindSelect.value || "all";
        apply();
      });
    }

    if (statusSelect) {
      statusSelect.addEventListener("change", function () {
        activeStatus = statusSelect.value || "all";
        apply();
      });
    }

    if (search) {
      var searchWrap = search.closest(".projects-toolbar__search-wrap--animated");
      search.addEventListener("input", apply);
      search.addEventListener("focus", function () {
        if (searchWrap) searchWrap.classList.add("is-search-focused");
      });
      search.addEventListener("blur", function () {
        if (searchWrap) searchWrap.classList.remove("is-search-focused");
      });
    }

    document.addEventListener("keydown", function (e) {
      if (!search) return;
      if (e.key !== "/") return;
      var tag = (e.target && e.target.tagName ? e.target.tagName : "").toLowerCase();
      var editing = tag === "input" || tag === "textarea" || (e.target && e.target.isContentEditable);
      if (editing) return;
      e.preventDefault();
      search.focus();
      search.select();
    });

    if (kindSelect) kindSelect.value = activeKind;
    if (statusSelect) statusSelect.value = activeStatus;
    apply();
  })();

  /* Subtle parallax on hero bg */
  if (!reduceMotion) {
    var bg = document.querySelector(".hero-bg img");
    window.addEventListener(
      "scroll",
      function () {
        if (!bg) return;
        var y = window.scrollY * 0.15;
        bg.style.transform = "translateY(" + (-22 + y * 0.02) + "%)";
      },
      { passive: true }
    );
  }

  /* Mouse-follow worm trail (desktop only) */
  var desktopPointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
  var traceCanvas = document.querySelector(".mouse-trace-canvas");
  if (!reduceMotion && desktopPointer && traceCanvas) {
    var ctx = traceCanvas.getContext("2d");
    var dpr = Math.max(1, window.devicePixelRatio || 1);
    var rafId = 0;
    var isActive = false;
    var targetX = window.innerWidth * 0.5;
    var targetY = window.innerHeight * 0.5;
    var cursorX = targetX;
    var cursorY = targetY;
    var prevCursorX = cursorX;
    var prevCursorY = cursorY;
    var POINTS_COUNT = 10;
    var CURSOR_OFFSET = 20;
    var tick = 0;
    var wormSegs = Array.from({ length: POINTS_COUNT }, function () {
      return { x: targetX, y: targetY };
    });

    function resizeCanvas() {
      dpr = Math.max(1, window.devicePixelRatio || 1);
      traceCanvas.width = Math.floor(window.innerWidth * dpr);
      traceCanvas.height = Math.floor(window.innerHeight * dpr);
      traceCanvas.style.width = window.innerWidth + "px";
      traceCanvas.style.height = window.innerHeight + "px";
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function drawTrail() {
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
      if (!isActive) return;
      var pixel = 2;
      for (var i = 1; i < wormSegs.length; i++) {
        var a = wormSegs[i - 1];
        var b = wormSegs[i];
        var t = 1 - i / wormSegs.length;
        var jitterA = Math.sin(tick * 0.11 + i * 1.71) * 0.9;
        var jitterB = Math.cos(tick * 0.09 + i * 1.33) * 0.9;
        var ax = Math.round((a.x + jitterA) / pixel) * pixel;
        var ay = Math.round((a.y + jitterB) / pixel) * pixel;
        var bx = Math.round((b.x - jitterB) / pixel) * pixel;
        var by = Math.round((b.y - jitterA) / pixel) * pixel;
        ctx.beginPath();
        ctx.moveTo(ax, ay);
        ctx.lineTo(bx, by);
        ctx.strokeStyle = "rgba(5, 6, 8, " + (0.2 + t * 0.72).toFixed(3) + ")";
        ctx.lineWidth = 0.8 + t * 2.6;
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
        ctx.stroke();

        if (i % 2 === 0) {
          ctx.fillStyle = "rgba(5, 6, 8, " + (0.14 + t * 0.48).toFixed(3) + ")";
          ctx.fillRect(ax - 1, ay - 1, 2, 2);
        }
      }
    }

    function tickTrail() {
      tick += 1;
      wormSegs[0].x += (targetX - wormSegs[0].x) * 0.42;
      wormSegs[0].y += (targetY - wormSegs[0].y) * 0.42;
      for (var i = 1; i < wormSegs.length; i++) {
        wormSegs[i].x += (wormSegs[i - 1].x - wormSegs[i].x) * 0.39;
        wormSegs[i].y += (wormSegs[i - 1].y - wormSegs[i].y) * 0.39;
      }
      drawTrail();
      rafId = requestAnimationFrame(tickTrail);
    }

    resizeCanvas();
    window.addEventListener("resize", resizeCanvas);

    window.addEventListener("mousemove", function (e) {
      cursorX = e.clientX;
      cursorY = e.clientY;
      var vx = cursorX - prevCursorX;
      var vy = cursorY - prevCursorY;
      var speed = Math.hypot(vx, vy) || 1;
      var nx = vx / speed;
      var ny = vy / speed;
      targetX = cursorX - nx * CURSOR_OFFSET;
      targetY = cursorY - ny * CURSOR_OFFSET;
      prevCursorX = cursorX;
      prevCursorY = cursorY;
      isActive = true;
    });

    window.addEventListener("mouseleave", function () {
      isActive = false;
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
    });

    window.addEventListener("blur", function () {
      isActive = false;
      ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
    });

    rafId = requestAnimationFrame(tickTrail);
  }

  /* Toolkit: animate percentage labels when section reveals */
  var toolkit = document.getElementById("toolkit");
  function runToolkitPct() {
    if (!toolkit || toolkit.dataset.pctAnimated === "1") return;
    toolkit.dataset.pctAnimated = "1";
    var rows = toolkit.querySelectorAll(".tool-row");
    rows.forEach(function (row, i) {
      var pctEl = row.querySelector(".tool-pct[data-target]");
      if (!pctEl) return;
      var target = parseInt(pctEl.getAttribute("data-target"), 10);
      if (isNaN(target)) return;
      if (reduceMotion) {
        pctEl.textContent = target + "%";
        return;
      }
      var delay = i * 88;
      var duration = 1450;
      var start = null;
      function tick(ts) {
        if (start === null) start = ts;
        var elapsed = ts - start - delay;
        if (elapsed < 0) {
          requestAnimationFrame(tick);
          return;
        }
        var t = Math.min(1, elapsed / duration);
        var eased = 1 - Math.pow(1 - t, 3);
        pctEl.textContent = Math.round(target * eased) + "%";
        if (t < 1) requestAnimationFrame(tick);
      }
      requestAnimationFrame(tick);
    });
  }
  if (toolkit) {
    if (toolkit.classList.contains("is-visible")) runToolkitPct();
    if ("MutationObserver" in window) {
      var tmo = new MutationObserver(function () {
        if (toolkit.classList.contains("is-visible")) runToolkitPct();
      });
      tmo.observe(toolkit, { attributes: true, attributeFilter: ["class"] });
    }
  }

  /* About modal */
  var aboutOverlay = document.getElementById("aboutOverlay");
  var aboutClose = document.getElementById("aboutClose");
  var brand = document.querySelector(".brand");
  var prevFocus = null;

  function openAbout() {
    if (!aboutOverlay) return;
    prevFocus = document.activeElement;
    aboutOverlay.hidden = false;
    aboutOverlay.classList.remove("is-closing");
    document.body.style.overflow = "hidden";
    aboutClose && aboutClose.focus();
  }

  function closeAbout() {
    if (!aboutOverlay || aboutOverlay.hidden) return;
    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduceMotion) {
      aboutOverlay.hidden = true;
      document.body.style.overflow = "";
      prevFocus && prevFocus.focus();
      return;
    }
    aboutOverlay.classList.add("is-closing");
    setTimeout(function () {
      aboutOverlay.hidden = true;
      aboutOverlay.classList.remove("is-closing");
      document.body.style.overflow = "";
      prevFocus && prevFocus.focus();
    }, 340);
  }

  if (brand && !brand.classList.contains("brand--home")) {
    brand.addEventListener("click", openAbout);
    brand.setAttribute("tabindex", "0");
    brand.setAttribute("role", "button");
    var ariaAbout =
      typeof window.PORTFOLIO_I18N !== "undefined" && window.PORTFOLIO_I18N.brandAriaAbout
        ? window.PORTFOLIO_I18N.brandAriaAbout
        : "Открыть информацию обо мне";
    brand.setAttribute("aria-label", ariaAbout);
    brand.addEventListener("keydown", function (e) {
      if (e.key === "Enter" || e.key === " ") { e.preventDefault(); openAbout(); }
    });
  }

  if (aboutClose) {
    aboutClose.addEventListener("click", closeAbout);
  }

  if (aboutOverlay) {
    aboutOverlay.querySelector(".about-backdrop").addEventListener("click", closeAbout);
    aboutOverlay.addEventListener("keydown", function (e) {
      if (e.key === "Escape") closeAbout();
    });
  }

  /* Header / footer: глобус + dropdown (язык — ссылки GET /locale/...) */
  (function initLangDropdowns() {
    var roots = document.querySelectorAll("[data-lang-dropdown]");
    if (!roots.length) return;
    function setOpen(root, open) {
      var btn = root.querySelector(".lang-dropdown__trigger");
      var menu = root.querySelector(".lang-dropdown__menu");
      if (!btn || !menu) return;
      root.classList.toggle("is-open", open);
      btn.setAttribute("aria-expanded", open ? "true" : "false");
      menu.setAttribute("aria-hidden", open ? "false" : "true");
    }
    roots.forEach(function (root) {
      var btn = root.querySelector(".lang-dropdown__trigger");
      if (!btn) return;
      btn.addEventListener("click", function (e) {
        e.stopPropagation();
        var open = !root.classList.contains("is-open");
        roots.forEach(function (r) {
          setOpen(r, r === root ? open : false);
        });
      });
    });
    document.addEventListener("click", function (e) {
      roots.forEach(function (root) {
        if (!root.contains(e.target)) setOpen(root, false);
      });
    });
    document.addEventListener("keydown", function (e) {
      if (e.key !== "Escape") return;
      roots.forEach(function (root) {
        if (!root.classList.contains("is-open")) return;
        setOpen(root, false);
        var b = root.querySelector(".lang-dropdown__trigger");
        if (b) b.focus();
      });
    });
  })();

  (function initLeadForms() {
    function csrfToken() {
      var m = document.querySelector('meta[name="csrf-token"]');
      return m && m.getAttribute("content") ? m.getAttribute("content") : "";
    }
    function leadMessages(kind) {
      var L = typeof window.PORTFOLIO_I18N !== "undefined" && window.PORTFOLIO_I18N.leads
        ? window.PORTFOLIO_I18N.leads
        : {};
      if (kind === "newsletter") {
        return { ok: L.newsOk || "OK", err: L.newsErr || "Error", rate: L.newsRate || "Rate limit" };
      }
      return { ok: L.contactOk || "OK", err: L.contactErr || "Error", rate: L.contactRate || "Rate limit" };
    }
    function firstValidationMessage(data) {
      if (!data || !data.errors) return null;
      var k = Object.keys(data.errors)[0];
      if (!k) return null;
      var arr = data.errors[k];
      return Array.isArray(arr) && arr.length ? arr[0] : null;
    }
    function bindForm(form) {
      var kind = form.getAttribute("data-lead-form");
      if (!kind) return;
      var action = form.getAttribute("action");
      if (!action) return;
      var msgs = leadMessages(kind);
      form.addEventListener("submit", function (e) {
        e.preventDefault();
        var btn = form.querySelector('button[type="submit"]');
        if (btn) btn.disabled = true;
        var fd = new FormData(form);
        fetch(action, {
          method: "POST",
          credentials: "same-origin",
          headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": csrfToken(),
          },
          body: fd,
        })
          .then(function (res) {
            return res.json().then(function (data) {
              return { res: res, data: data };
            });
          })
          .then(function (pair) {
            var res = pair.res;
            var data = pair.data;
            if (res.status === 429) {
              alert(msgs.rate);
              return;
            }
            if (res.status === 422) {
              var v = firstValidationMessage(data) || data.message || msgs.err;
              alert(v);
              return;
            }
            if (!res.ok || !data || !data.ok) {
              alert(msgs.err);
              return;
            }
            alert(msgs.ok);
            form.reset();
          })
          .catch(function () {
            alert(msgs.err);
          })
          .finally(function () {
            if (btn) btn.disabled = false;
          });
      });
    }
    document.querySelectorAll("form[data-lead-form]").forEach(bindForm);
  })();

})();
