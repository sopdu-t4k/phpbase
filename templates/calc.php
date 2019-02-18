<h1>Калькулятор</h1>
<form class="form-inline mt-5 mb-5">
    <input type="number" class="form-control mr-sm-2" name="operand1" value="<?=$operand1;?>" required>
    <select class="form-control mr-sm-2" name="operation">    
        <? foreach ($operations as $operation): ?>
            <option value="<?=$operation['value'];?>" <?=$operation['selected']?'selected':'';?>><?=$operation['option'];?></option>
        <? endforeach; ?>
    </select>
    <input type="number" class="form-control mr-sm-2" name="operand2" value="<?=$operand2;?>" required>
    <input type="submit" class="form-control mr-sm-2 btn btn-secondary" value="=" name="submit" title="Посчитать">
    <input type="text" class="form-control mr-sm-2" name="rezult" value="<?=$rezult;?>" disabled>
    <a href="/calc/" class="btn btn-light">Сбросить</a>
</form>
<h3>Ajax-калькулятор</h3>
<div class="row">
    <div class="col-4 mt-5 mb-5">
        <form id="ajx-calc">
            <div class="form-group row">
                <label class="col-5 col-form-label text-right">Первое число:</label>
                <div class="col-7">
                    <input type="number" class="form-control" name="ajx-operand1" value="" required>
                </div>                
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label text-right">Второе число:</label>
                <div class="col-7">
                    <input type="number" class="form-control" name="ajx-operand2" value="" required>
                </div>                
            </div>
            <div class="form-group row">
                <div class="col-5 col-form-label text-right">Действие:</div>
                <div class="col-7">
                    <button type="submit" name="plus" class="btn btn-secondary mr-sm-2" title="Сложить">+</button>
                    <button type="submit" name="minus" class="btn btn-secondary mr-sm-2" title="Вычесть">-</button>
                    <button type="submit" name="mult" class="btn btn-secondary mr-sm-2" title="Умножить">*</button>
                    <button type="submit" name="div" class="btn btn-secondary mr-sm-2" title="Разделить">/</button>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-5 col-form-label text-right">Результат:</label>
                <div class="col-7">
                    <input type="text" class="form-control" name="ajx-rezult" value="" disabled>
                </div>                
            </div>
            <div class="form-group text-right">
                <input type="reset" class="btn btn-light">
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $('#ajx-calc button').on('click', function(e) {
            e.preventDefault();
            var formData = $('#ajx-calc').serialize() + '&ajx-operation=' + $(this).attr('name');
            $.ajax({
                url: '/calc/math/',
                type: 'POST',
                dataType: 'json',
                data: formData,
                error: function() {
                    alert('Ошибка обработки запроса!');
                },
                success: function(response) {
                    $('#ajx-calc input[name=ajx-rezult]').val(response.ajx_rezult);
                }
            });
        });
    });
</script>
