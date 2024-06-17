const customQuantityButton = document.getElementById("yourQuantityBtn");
const customSizeButton = document.getElementById("yourSizeBtn");
const quantityControl = document.querySelector(".quantity_field__control");
const sizeControl = document.querySelector(".size_field__control");
const fixedSizeButton = document.querySelectorAll(".fixed_size_btn");
const fixedQuantityButton = document.querySelectorAll(".fixed_quantity_btn");


export function initializeConstructorInputs(){
    customQuantityButton.addEventListener("click", function() {
        customQuantityButton.style.display = "none";
        quantityControl.classList.add("quantity_field__control--active");
        fixedQuantityButton.forEach(button => {
        button.classList.remove("quantity_field__value--active");
        });
    });

    customSizeButton.addEventListener("click", function() {
        customSizeButton.style.display = "none";
        sizeControl.classList.add("size_field__control--active");
        fixedSizeButton.forEach(button => {
        button.classList.remove("size_field__value--active");
        });
    }); 
}