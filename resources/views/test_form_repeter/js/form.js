let count = 1;
 
$('#add_row').on('click', function (e) {
    e.preventDefault();
    let grade = document.querySelector(`select#grade_id${count}`);
    let ajaxUrl = grade.getAttribute('data-url')
    let gradeOptions = grade.getElementsByTagName('option');
    let options = '';

    for (const option in gradeOptions) {
        if (Object.hasOwnProperty.call(gradeOptions, option)) {
            const element = gradeOptions[option];
            options += `<option value="${element.value}">${element.innerText}</option>`;
        }
    }
    
    count++;

    let newSectionRow =
    `<div class="row border p-2 mb-2" id="section_row_${count}">
        <div class="d-flex justify-content-between">
            <h3 class="mt-3 mb-3 f-bold f-size-20 text-secondary">
                بيانات القسم رقم ( ${count} )
            </h3>
            <button class="btn btn-danger mt-3 mb-3 remove_row" id="${count}">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <hr>
        <div class="col-md-3 col-sm-6">
            <label for="section_name_ar${count}" class="mb-2">أسم القسم بالعربية</label>
            <input type="text" name="section_name_ar[]" class="form-control section_name_ar"  id="section_name_ar${count}"/>
        </div>
        <div class="col-md-3 col-sm-6">
            <label for="section_name_en${count}" class="mb-2">أسم القسم بالإنجليزية</label>
            <input type="text" name="section_name_en[]" class="form-control section_name_en" id="section_name_en${count}" />
        </div>
    
        <div class="col-md-3 col-sm-6">
            <label for="grade_id${count}" class="mb-2">
                المرحلة الدراسية
            </label>
            <select name="grade_id[]" class="form-control grade_id" id="grade_id${count}" data-url="${ajaxUrl}">
                ${options}    
            </select>
        </div>
        
        <div class="col-md-3 col-sm-6">
            <label for="class_id${count}" class="mb-2">
                الصف الدراسي
            </label>
            <select name="class_id[]" class="form-control class_id" id="class_id${count}"></select>
        </div>

        <div class="col-md-12">
            <label for="teacher_id${count}" class="mb-2 mt-2">اسم المعلم</label>
            <select multiple name="teacher_id[]" class="form-control teacher_id" id="teacher_id${count}">
                <option value="1">علي محمد</option>
                <option value="2">عثمان محمد</option>
                <option value="3">أسامه محمد</option>
                <option value="4">أسعد محمد</option>
                <option value="5">مصطفى الطاهر</option>
                <option value="6">أحمد علي</option>
            </select>
        </div>

        <div class="col-md-12">
            <label for="status${count}" class="mt-2">
                الحالة
                <input type="checkbox" class="form-check-input" name="status[]" id="status${count}">
            </label>
        </div>
    </div>`;

    // validationFields();
    
    $('#section_row').append(newSectionRow)
});


$(document).on('click', '.remove_row', function (e) {
    e.preventDefault();
    count--;
    let row_id = $(this).attr('id');
    $('#section_row_' + row_id).remove();

});

$(document).on('change', '.grade_id', function (e) 
{
    let url = $(this).data('url');
    let token = $('input[name="_token"]').val();
    let grade_id = $(this).val();
    let classes = $(this).parents('div.row').find('select[name="class_id"]');
    
    if (grade_id) {
        $.ajax({
            url: url,
            data: {
                id: grade_id,
                _token: token
            },
            type: "POST",
            dataType: "json",
            success: function (data) {
                if (data) {
                    class_id.empty();
                    $.each(data, function (key, value) {
                        class_id.append(`<option value="${key}">${value}</option>`);
                    });
                }
            },
        });
    } 
    else 
    {
        console.log('AJAX load did not work');
    }

});

function validationFields() {
    
    for(let no=1; no<=count;no++)
    {
        if($.trim($('#section_name_ar'+no).val()).length == 0){
            $('#section_name_ar'+no).focus();
            return false;
        }

        if($.trim($('#section_name_en'+no).val()).length == 0){
            $('#section_name_en'+no).focus();
            return false;
        }

        if($.trim($('#grade_id'+no).val()).length == 0){
            $('#grade_id'+no).focus();
            return false;
        }

        if($.trim($('#class_id'+no).val()).length == 0){
            $('#class_id'+no).focus();
            return false;
        }

        if($.trim($('#teacher_id'+no).val()).length == 0){
            $('#teacher_id'+no).focus();
            return false;
        }
    }
}
