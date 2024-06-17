const materialButtons = document.querySelectorAll('.material_field__value');
const fixedSizeButtons = document.querySelectorAll('.fixed_size_btn');
const customSizeButton = document.getElementById("yourSizeBtn");
const sizeControl = document.querySelector(".size_field__control");
const fixedQuantityButtons = document.querySelectorAll('.fixed_quantity_btn');
const quantityButton = document.getElementById("yourQuantityBtn");
const quantityControl = document.querySelector(".quantity_field__control");

export function initializeConstructorBtns() {
        // Функция для обработки клика по материалам
        function handleMaterialClick() {
            materialButtons.forEach(btn => btn.classList.remove('material_field__value--active'));
            this.classList.add('material_field__value--active');
        }

        // Функция для обработки клика по размерам
        function handleSizeClick() {
            fixedSizeButtons.forEach(btn => btn.classList.remove('size_field__value--active'));
            this.classList.add('size_field__value--active');
            sizeControl.classList.remove("size_field__control--active");
            customSizeButton.style.display = "flex";
        }

        // Функция для обработки клика по количеству
        function handleQuantityClick() {
            fixedQuantityButtons.forEach(btn => btn.classList.remove('quantity_field__value--active'));
            this.classList.add('quantity_field__value--active');
            quantityControl.classList.remove("quantity_field__control--active");
            quantityButton.style.display = "grid";
        }

        // Получение всех необходимых элементов из HTML

        // Добавление обработчиков событий
        materialButtons.forEach(button => {
            button.addEventListener('click', handleMaterialClick);
        });

        fixedSizeButtons.forEach(button => {
            button.addEventListener('click', handleSizeClick);
        });

        fixedQuantityButtons.forEach(button => {
            button.addEventListener('click', handleQuantityClick);
        });
    ;
}