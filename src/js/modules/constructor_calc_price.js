export function initCalculator(){
    const materialsContainer = document.querySelector('.material_field');
    const sizesContainer = document.querySelector('.size_field');
    const quantitiesContainer = document.querySelector('.quantity_field');
    const sizeInputWidth = document.querySelector("#input_number_width");
    const sizeInputHeight = document.querySelector("#input_number_height");
    const quantityInput = document.querySelector("#input_number__quantity");
    const totalPriceSpan = document.getElementById('total-price');
    const yourQuantityBtn = document.getElementById('yourQuantityBtn');

    const materialPost = document.querySelector("input[name='material']");
    const sizePost= document.querySelector("input[name='size']");
    const quantityPost = document.querySelector("input[name='quantity']");
    const pricePost = document.querySelector("input[name='price']");

    // Массив данных о материалах
    // const materials = [
    //     {"materialName":"Белая матовая", "materialCoefficient": 1},
    //     {"materialName":"Белая с глянцевой ламинацией", "materialCoefficient": 1.3},
    //     {"materialName":"Прозрачная матовая", "materialCoefficient": 1.3},
    //     {"materialName":"Прозрачная глянцевая", "materialCoefficient": 1.6},
    //     {"materialName":"Голографическая", "materialCoefficient": 2.3}
    // ];
    const materials = [];
    document.querySelectorAll('.material_field__value').forEach(function(element) {
        const materialName = element.querySelector('.material_name').textContent;
        const materialCoefficient = element.getAttribute('data-coefficient');
        
        materials.push({
            materialName: materialName,
            materialCoefficient: parseFloat(materialCoefficient)
        });
    });

    // console.log(materials);

    // Массив данных о тиражах
    // const quantities = [
    //     {"quantity": 50, "sale": 16},
    //     {"quantity": 100, "sale": 30},
    //     {"quantity": 200, "sale": 45},
    //     {"quantity": 300, "sale": 60},
    //     {"quantity": 500, "sale": 70}
    // ];
    const quantities = [];
    document.querySelectorAll('.fixed_quantity_btn').forEach(function(element) {
        const quantity = element.querySelector('.quantity_option').textContent;
        const sale = element.getAttribute('data-sale');
        
        quantities.push({
            quantity: parseInt(quantity),
            sale: parseFloat(sale)
        });
    });

    // Функция для обновления временной цены
    function updateTempPrice() {
        let material = '';
        let width = 0;
        let height = 0;
        let quantity = 0;

        // Получение выбранного материала
        materialsContainer.querySelectorAll('.material_field__value').forEach(materialButton => {
            if (materialButton.classList.contains('material_field__value--active')) {
                material = materialButton.querySelector('p').textContent;

                materialPost.value = material;
            }
        });

        // Получение выбранного размера
        sizesContainer.querySelectorAll('.size_field__value').forEach(sizeButton => {
            if (sizeButton.classList.contains('size_field__value--active')) {
                const dimensions = sizeButton.querySelector('p').textContent.split('x');
                width = parseFloat(dimensions[0]);
                height = parseFloat(dimensions[1]);

                sizePost.value = sizeButton.querySelector('p').textContent;
            }
        });

        // Если не выбран размер, берем значения из полей ввода
        if (!width || !height) {
            width = parseFloat(sizeInputWidth.value) || 0;
            height = parseFloat(sizeInputHeight.value) || 0;

            sizePost.value = width + 'x' + height;
        }

        // Получение выбранного тиража
        const tempPriceSpans = Array.from(quantitiesContainer.querySelectorAll(".temp_price")).slice(1);

        quantitiesContainer.querySelectorAll('.fixed_quantity_btn').forEach((button, index) => {
            const quantity = parseInt(button.querySelector('p').textContent);
            const quantityData = quantities.find(item => item.quantity === quantity);
            const coefficient = materials.find(mat => mat.materialName === material).materialCoefficient;

            // Расчет общей стоимости без учета скидки
            let totalPrice = coefficient * (width * height) * quantity;

            // Применение скидки
            totalPrice *= (1 - quantityData.sale / 100);

            // Округление до целого знака
            totalPrice = Math.round(totalPrice);
            const formattedPrice = totalPrice.toLocaleString() + " ₽";
            const tempPriceSpan = tempPriceSpans[index];
            tempPriceSpan.textContent = formattedPrice;
        });

        if (quantityInput) {
            const quantity = parseInt(quantityInput.value);
            quantityPost.value = quantity;
            if (isNaN(quantity)) {
                // Если значение не число, оставляем span пустым и выходим из функции
                const tempPriceSpan = quantityInput.parentNode.querySelector('.temp_price');
                tempPriceSpan.textContent = '';
                return;
            }

            // Находим ближайшее количество в массиве quantities, которое меньше или равно введенному значению
            let nearestQuantityData = null;
            for (let i = quantities.length - 1; i >= 0; i--) {
                if (quantities[i].quantity <= quantity) {
                    nearestQuantityData = quantities[i];
                    break;
                }
            }
            // Применяем скидку, если она найдена
            let sale = 0;
            if (nearestQuantityData) {
                sale = nearestQuantityData.sale;
            }
            // Расчет общей цены с учетом скидки
            const coefficient = materials.find(mat => mat.materialName === material).materialCoefficient;
            let totalPrice = coefficient * (width * height) * quantity;
            if (sale) {
                totalPrice *= (1 - sale / 100);
            }
            totalPrice = Math.round(totalPrice);
            const formattedPrice = totalPrice.toLocaleString() + " ₽";

            // Обновление временной цены
            const tempPriceSpan = quantityInput.parentNode.querySelector('.temp_price');
            tempPriceSpan.textContent = formattedPrice;
        }

        // Обновление итоговой цены
        updateTotalPrice();
    }

    // Функция для обновления итоговой цены
    function updateTotalPrice() {
        const activeQuantityBlock = quantitiesContainer.querySelector('.quantity_field__value--active');
        if (activeQuantityBlock) {
            const tempPriceSpan = activeQuantityBlock.querySelector('.temp_price');
            totalPriceSpan.textContent = tempPriceSpan.textContent;

            quantityPost.value = activeQuantityBlock.querySelector('p').textContent;
            pricePost.value = totalPriceSpan.textContent.replace(/\D/g, '');
        }
    }

    function updateTotalPriceFromQuantity() {
        const tempPriceSpan = quantityInput.parentNode.querySelector('.temp_price');
        totalPriceSpan.textContent = tempPriceSpan.textContent;
        pricePost.value = totalPriceSpan.textContent.replace(/\D/g, '');
    }


    // Обновление временной цены при изменении материала или размера
    materialsContainer.querySelectorAll('.material_field__value').forEach(materialButton => {
        materialButton.addEventListener('click', function() {
            updateTempPrice();
            if (quantityInput) {
                updateTotalPriceFromQuantity();
            }
            updateTotalPrice();
        });
    });

    quantitiesContainer.querySelectorAll('.fixed_quantity_btn').forEach(quantityButton => {
        quantityButton.addEventListener('click', function() {
            updateTempPrice();
            updateTotalPrice();
        });
    });

    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            updateTempPrice(); // Обновляем промежуточную цену
            updateTotalPriceFromQuantity(); // Обновляем итоговую цену из промежуточной цены, связанной с quantityInput
        });
    }

    if (yourQuantityBtn) {
        yourQuantityBtn.addEventListener('click', function() {
            updateTempPrice();
            updateTotalPriceFromQuantity();
        });
    }

    sizesContainer.querySelectorAll('.size_field__value').forEach(sizeButton => {
        sizeButton.addEventListener('click', function() {
            updateTempPrice();
            if (quantityInput) {
                updateTotalPriceFromQuantity();
            }
            updateTotalPrice();
        });
    });

    sizeInputWidth.addEventListener('input', function() {
        updateTempPrice();
        if (quantityInput) {
            updateTotalPriceFromQuantity();
        }
        updateTotalPrice();
    });
    sizeInputHeight.addEventListener('input', function() {
        updateTempPrice();
        if (quantityInput) {
            updateTotalPriceFromQuantity();
        }
        updateTotalPrice();
    });

    // Инициализация временной цены
    updateTempPrice();
}
