// Navigation functionality
document.addEventListener("DOMContentLoaded", function () {
  // Mobile menu toggle
  const mobileMenuButton = document.getElementById("mobile-menu-button");
  const mobileMenu = document.getElementById("mobile-menu");

  mobileMenuButton.addEventListener("click", function () {
    mobileMenu.classList.toggle("hidden");
  });

  // Auth dropdown toggle
  const authDropdownBtn = document.getElementById("auth-dropdown-btn");
  const authDropdown = document.getElementById("auth-dropdown");

  authDropdownBtn.addEventListener("click", function () {
    authDropdown.classList.toggle("hidden");
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (event) {
    if (
      !authDropdownBtn.contains(event.target) &&
      !authDropdown.contains(event.target)
    ) {
      authDropdown.classList.add("hidden");
    }
  });

  // Page navigation
  const navLinks = document.querySelectorAll(
    '.nav-link, #mobile-menu a, #auth-dropdown a, footer a[href^="#"]',
  );
  const pages = document.querySelectorAll(".page");

  // Function to show a specific page and hide others
  function showPage(pageId) {
    pages.forEach((page) => {
      if (page.id === pageId + "-page") {
        page.classList.remove("hidden");
        page.classList.add("active");
      } else {
        page.classList.add("hidden");
        page.classList.remove("active");
      }
    });

    // Update active nav link
    navLinks.forEach((link) => {
      if (link.getAttribute("href") === "#" + pageId) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  }

  // Listen for navigation clicks
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const href = this.getAttribute("href");
      if (href && href.startsWith("#")) {
        const targetId = href.substring(1);
        const targetElement = document.getElementById(targetId);

        // Keep in-page anchors like Services and Doctors as scroll targets.
        if (targetElement && !targetId.endsWith("-page")) {
          e.preventDefault();
          targetElement.scrollIntoView({ behavior: "smooth", block: "start" });

          if (!mobileMenu.classList.contains("hidden")) {
            mobileMenu.classList.add("hidden");
          }

          if (!authDropdown.classList.contains("hidden")) {
            authDropdown.classList.add("hidden");
          }

          return;
        }

        e.preventDefault();
        const pageId = targetId;
        showPage(pageId);
        // Close mobile menu after navigation
        if (!mobileMenu.classList.contains("hidden")) {
          mobileMenu.classList.add("hidden");
        }
        // Close auth dropdown after navigation
        if (!authDropdown.classList.contains("hidden")) {
          authDropdown.classList.add("hidden");
        }
      }
    });
  });

  // Optionally, show the correct page on load based on hash
  if (window.location.hash) {
    const pageId = window.location.hash.substring(1);
    showPage(pageId);
  } else {
    showPage("home");
  }
});

// Add this inside your <script> tag, after DOMContentLoaded


// Close modal functionality
// document.getElementById('close-modal')?.addEventListener('click', function() {
//     const modal = document.getElementById('appointment-modal');
//     modal.classList.add('hidden');
// });

document.getElementById("close-modal")?.addEventListener("click", function () {
  document.getElementById("appointment-modal").classList.add("hidden");
});
