window.addEventListener("load", function () {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownContent = document.getElementById("dropdownContent");
    const dropdownWrapper = document.querySelector(".dropdown-wrapper");

    // Set the initial width of the dropdown menu to match the wrapper's width
    dropdownContent.style.width = dropdownWrapper.offsetWidth - 4 + "px"; // Subtract 4px to account for border width

    // Close the dropdown when the button is clicked
    dropdownButton.addEventListener("click", function () {
        dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
});