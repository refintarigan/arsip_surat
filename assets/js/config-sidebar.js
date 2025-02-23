// $(document).ready(function () {
//   function setupSidebar(sidebarSelector) {
//     var currentUrl = window.location.href.split(/[?#]/)[0]; // Ambil URL tanpa parameter

//     // Reset status menu
//     $(sidebarSelector + " li").removeClass("menu-open");
//     $(sidebarSelector + " li a").removeClass("active");

//     // Cari menu yang cocok dengan URL saat ini
//     var activeMenu = $(sidebarSelector + " a").filter(function () {
//       return this.href.split(/[?#]/)[0] === currentUrl;
//     });

//     if (activeMenu.length > 0) {
//       activeMenu.addClass("active");
//       activeMenu.closest(".nav-treeview").slideDown();
//       activeMenu.closest(".has-treeview").addClass("menu-open");
//     }

//     // Event klik menu sidebar
//     $(sidebarSelector + " .has-treeview > a").on("click", function (e) {
//       e.preventDefault(); // Cegah reload jika menu utama diklik

//       var parent = $(this).parent();
//       var isOpen = parent.hasClass("menu-open");

//       // Tutup semua menu lain yang terbuka dalam sidebar ini
//       $(sidebarSelector + " .has-treeview").removeClass("menu-open");
//       $(sidebarSelector + " .nav-treeview").slideUp();

//       // Jika menu ini tidak sedang terbuka, buka
//       if (!isOpen) {
//         parent.addClass("menu-open");
//         parent.find(".nav-treeview").slideDown();
//       }
//     });
//   }

//   // Panggil fungsi untuk sidebar utama
//   setupSidebar(".sidebar");
// });
