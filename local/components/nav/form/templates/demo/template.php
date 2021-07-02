<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div style="display: none;">
<div class="review-form">
    <form>
        <div class="text">Нам важно знать ваше мнение!</div>
        <div class="row">
            <label>Ваше имя:</label>
            <input type="text" name="name" required/>
        </div>
        <div class="row">
            <label>Текст отзыва:</label>
            <textarea name="text" required></textarea>
        </div>
        <div class="row" style="text-align: center; padding-top: 5px; padding-bottom: 0px;">
            <button class="review-form-submit">Отправить</button>
            <input type="hidden" name="_protect" value=""/>
            <input type="hidden" name="sessid" value=""/>
            <input type="hidden" name="formId" value="myform"/>
        </div>
    </form>
</div>
</div>
<script>
$(function () {
    $('#addReview').on('click', function (e) {
        e.preventDefault();

        $.fancybox({
            content: $('.review-form').parent().html(),
            onComplete: function () {
                $('.review-form form').off('submit.custom').on('submit.custom', function (e) {
                    e.preventDefault();

                    var self = this;
                    $(this).find('[name="_protect"]').val('3e8yawhf723');
                    $(this).find('[name="sessid"]').val(BX.message('bitrix_sessid'));

                    $.ajax({
                        url: '/local/public/review_form.php',
                        type: 'post',
                        data: $(this).serializeArray(),
                        dataType: 'json',
                    }).done(function (data) {
                        if (data.status == 'error') {
                            var errors = '';

                            for (var i = 0; i < data.errors.length; i++) {
                                errors += data.errors[i].text + '\n';
                            }

                            alert(errors);
                            return;
                        }

                        $(self).replaceWith('<div class="review-form-success" style="line-height: 1.1em;">Спасибо, мы опубликуем ваш отзыв после модерации.</div>');
                        $.fancybox.resize();
                    });
                });
            }
        });
    });

});
</script>
<a href="#" id="addReview">Оставить отзыв</a><br/><br/>
<div class="reviews-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="review-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="text">
            <span class="date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span><br/>
            <a class="review-title" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a><br/>
            <?=$arItem['DETAIL_TEXT']?>
        </div>
    </div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
