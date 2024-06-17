export function previewUploadedImage() {
    document.getElementById('input-file').addEventListener('change', function() {
        var file = this.files[0]; // Получаем первый загруженный файл
        if (file) {
            var reader = new FileReader(); // Создаем объект FileReader

            reader.onload = function(e) {
                // Когда файл загружен, устанавливаем его содержимое в качестве src для изображения
                document.getElementById('file-preview').setAttribute('src', e.target.result);
            }

            // Читаем содержимое файла как URL данных
            reader.readAsDataURL(file);
        }
    })
}

