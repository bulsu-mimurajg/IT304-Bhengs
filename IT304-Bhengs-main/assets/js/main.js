// window.addEventListener("scroll", function () {
//   const header = document.getElementById("header");
//   if (window.scrollY > 50) {
//     // Adjust scroll threshold as needed
//     header.classList.add("scrolled");
//   } else {
//     header.classList.remove("scrolled");
//   }
// });


// FAQ

function toggleFaq(element) {
  const content = element.nextElementSibling; // Get the next sibling, which is the content
  const isOpen = content.style.display === "block";

  // Close all open accordion items
  document.querySelectorAll(".faq-content").forEach((item) => {
    item.style.display = "none";
  });

  // Toggle the clicked one
  if (!isOpen) {
    content.style.display = "block"; // Open only if it was previously closed
  }
}

