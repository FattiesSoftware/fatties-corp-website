jQuery(document).ready(function ($) {
  // Initialize AOS (Animate On Scroll)
  if (typeof AOS !== "undefined") {
    AOS.init();
  }

  // Dynamic years
  var yearsEl = document.getElementById("years-before-init");
  if (yearsEl) {
    yearsEl.innerHTML = new Date().getFullYear() - 2020;
  }

  var yearsEl2 = document.getElementById("years-before-init2");
  if (yearsEl2) {
    yearsEl2.innerHTML = new Date().getFullYear() - 2020;
  }

  var currentYearEl = document.getElementById("current-year");
  if (currentYearEl) {
    currentYearEl.innerHTML = new Date().getFullYear();
  }

  // Waves
  if (typeof Waves !== "undefined") {
    Waves.attach(".button", ["waves-button", "waves-float", "waves-light"]);
    Waves.init();
  }

  // Navbar scroll behavior
  const navbar = $("#main-navbar");
  if (navbar.length) {
    // Kiểm tra xem có phải trang chủ không
    const isHomePage =
      navbar.data("is-homepage") === "true" ||
      navbar.data("is-homepage") === true;

    if (isHomePage) {
      // Trang chủ: áp dụng cơ chế scroll > 50px để hiện navbar
      const scrollThreshold = 50;
      let lastScrollTop = 0;
      let ticking = false;

      function handleNavbarScroll() {
        if (!ticking) {
          window.requestAnimationFrame(function () {
            const scrollTop = $(window).scrollTop();

            if (scrollTop > scrollThreshold) {
              // Scroll xuống > 50px: hiển thị navbar với fade in
              navbar.removeClass("fade-up-out").addClass("visible");
            } else {
              // Scroll lên về đầu trang: fade up out mượt mà
              navbar.removeClass("visible").addClass("fade-up-out");
            }

            lastScrollTop = scrollTop;
            ticking = false;
          });

          ticking = true;
        }
      }

      // Xử lý scroll event với throttling
      $(window).on("scroll", handleNavbarScroll);

      // Kiểm tra trạng thái ban đầu (nếu đã scroll sẵn)
      handleNavbarScroll();
    } else {
      // Các trang khác: luôn hiển thị navbar
      navbar.removeClass("fade-up-out").addClass("visible");
    }
  }

  // Mobile menu toggle
  $("#navbar-toggle").on("click", function () {
    $(this).toggleClass("active");
    $(".navbar-menu").toggleClass("active");
  });

  // Close mobile menu when clicking on a link
  $(".nav-link").on("click", function (e) {
    // Check if this is the "Services" link inside a dropdown wrapper
    var $dropdownWrapper = $(this).closest('.nav-item-dropdown');

    if ($dropdownWrapper.length > 0 && window.innerWidth < 993) {
      if (!$(e.target).closest('.dropdown-menu').length) {
        // It's the main service button, prevent default link behavior and toggle
        e.preventDefault();
        e.stopImmediatePropagation();
        $dropdownWrapper.toggleClass('dropdown-open');
        return;
      }
    }

    // For other links or if not mobile, close the menu
    $("#navbar-toggle").removeClass("active");
    $(".navbar-menu").removeClass("active");
  });

  // Smooth scroll for navbar links - scroll ngay lập tức
  $(".nav-link").on("click", function (e) {
    const href = $(this).attr("href");
    const isHomePage =
      navbar.length &&
      (navbar.data("is-homepage") === "true" ||
        navbar.data("is-homepage") === true);

    // Xử lý link anchor
    if (href && href.includes("#")) {
      const hashIndex = href.indexOf("#");
      const hash = href.substring(hashIndex);
      const urlWithoutHash = href.substring(0, hashIndex);
      const currentUrl = window.location.origin + window.location.pathname;

      // Nếu link có URL khác với trang hiện tại (ví dụ: từ trang contact click vào link về trang chủ)
      if (
        urlWithoutHash &&
        urlWithoutHash !== currentUrl &&
        urlWithoutHash !== "" &&
        urlWithoutHash !== "#"
      ) {
        // Cho phép chuyển trang bình thường, browser sẽ tự xử lý scroll sau khi load
        return;
      }

      // Nếu đang ở trang chủ, xử lý scroll
      if (isHomePage && hash) {
        e.preventDefault();
        const target = $(hash);
        if (target.length) {
          // Stop any ongoing animation
          $("html, body").stop(true, true);
          // Calculate target position
          const targetPosition = target.offset().top - 80;
          // Scroll immediately using native smooth scroll for better performance
          window.scrollTo({
            top: targetPosition,
            behavior: "smooth",
          });
        }
      }
    }
  });

  // Xử lý scroll khi load trang với hash (ví dụ: từ trang khác chuyển đến trang chủ với anchor)
  if (window.location.hash) {
    const hash = window.location.hash;
    const target = $(hash);
    const isHomePage =
      navbar.length &&
      (navbar.data("is-homepage") === "true" ||
        navbar.data("is-homepage") === true);
    if (target.length && isHomePage) {
      // Đợi trang load xong rồi scroll
      setTimeout(function () {
        const targetPosition = target.offset().top - 80;
        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });
      }, 100);
    }
  }
});

// Global function for onclick - Filter projects by category
function categoryChange(to) {
  var $ = jQuery;

  // Remove active class from all buttons
  $(".button").removeClass("active");

  // Add active class to clicked button
  if (to == "all") {
    $("#cat-all").addClass("active");
  } else {
    $("#cat-" + to).addClass("active");
  }

  // Filter projects
  var $projects = $(".project-card");
  var visibleCount = 0;

  $projects.each(function () {
    var $project = $(this);
    var categories = $project.data("category");
    var shouldShow = false;

    if (to == "all") {
      shouldShow = true;
    } else if (categories) {
      var categoryArray = categories.split(" ");
      shouldShow = categoryArray.indexOf(to) !== -1;
    }

    if (shouldShow) {
      $project.fadeIn(300);
      visibleCount++;
    } else {
      $project.fadeOut(200);
    }
  });
}
window.categoryChange = categoryChange;
