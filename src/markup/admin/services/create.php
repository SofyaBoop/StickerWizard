<?php
include("../../blocks/path.php");
include("../../controllers/services.php");
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    @@include('../../blocks/head_admin.html')
    <title>service_create_sticker_wizard</title>
</head>

<body>
    @@include('../../blocks/header_admin.php')
    <main>
        @@include('../../modal_windows/modal_notice_exit.php')
        <div class="admin_panel_block">
            @@include('../../blocks/sidebar_admin.php')
            <h3>Создание услуги</h3>
            <div class="admin_act_btn_block">
                <a href="<?php echo BASE_URL . "/admin/services/index.php"; ?>" class="admin_act_btn admin_act_btn__back_to_index">Назад к списку</a>
                <span class="col-1"></span>
            </div>
            <section class="row create_admin_section">
                <div class="create_service__block_errMsg block_errMsg">
                    <?php include "../../helps/errorInfo.php"; ?>
                </div>
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <div class="create_service_field">
                        <label for="formGroupExampleInput" class="form-label">Название</label>
                        <input name="input_create_service__name" value="<?= $service_name; ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Название услуги...">
                    </div>
                    <div class="create_service_field">
                        <select name="service_size" class="form-select mb-2" aria-label="Default select example">
                            <option selected>Размер:</option>
                            <?php foreach ($services_size as $key => $service_size) : ?>
                                <option value="<?= $service_size['id']; ?>"><?= $service_size['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="create_service_field">
                        <label for="editor" class="form-label">Описание услуги</label>
                        <textarea name="descryption" id="editor" class="form-control" rows="6"><?= $descryption; ?></textarea>
                    </div>
                    <div class="input-group mb-3 create_service_field">
                        <input name="image" type="file" accept=".jpg, .jpeg, .png" class="input_create_service__image" id="inputGroupFile02">
                    </div>
                    <div class="create_service_field_check_admin">
                        <input name="input_create_service__status" class="form_check_input" value="1" type="checkbox" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Publish?
                        </label>
                    </div>
                    <div class="create_service_field">
                        <button name="create-service" class="create_service_btn create_btn" type="submit">Создать</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    @@include('../../blocks/footer_admin.php')
    <script src="../../js/admin.bundle.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });
    </script>
</body>

</html>