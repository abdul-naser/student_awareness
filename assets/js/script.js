$(function() {
    // Create New Row
    $('#add_member').click(function() {
        if ($('tr[data-id=""]').length > 0) {
            $('tr[data-id=""]').find('[name="name"]').focus()
            return false;
        }
        var tr = $('<tr>')
        $('input[name="id"]').val('')
        tr.addClass('py-1 px-2');
        tr.attr('data-id', '');
        tr.append('<td contenteditable name="qualification"></td>')
        tr.append('<td contenteditable name="experience"></td>')
        tr.append('<td contenteditable name="implement"></td>')
        tr.append('<td contenteditable name="note"></td>')
        tr.append('<td class="text-center"><button class="btn btn-sm btn-primary btn-flat rounded-0 px-2 py-0">Save</button><button class="btn btn-sm btn-dark btn-flat rounded-0 px-2 py-0" onclick="cancel_button($(this))" type="button">Cancel</button></td>')
        $('#form-tbl').append(tr)
        tr.find('[name="name"]').focus()
    })

    // Edit Row
    $('.edit_data').click(function() {
        var id = $(this).closest('tr').attr('data-id')
        $('input[name="id"]').val(id)
        var count_column = $(this).closest('tr').find('td').length


        // $(this).closest('tr').find('td').each(function() {
        //     if ($(this).index() != (count_column - 1))
        //         $(this).attr('contenteditable', true)
        // })

// Try if need input 
        $(this).closest('tr').find('td').each(function() {
            if ($(this).index() != (count_column - 1)) {
                // Get the current text content
                var currentText = $(this).text();
           // Get the data-name attribute value for the current td
           var tdName = $(this).attr('name');

             // Determine the input type based on the tdName
    var inputType = (tdName === 'date') ? 'date' : 'text';
    var inputClass;

switch(tdName) {
    case 'date':
        inputClass = 'datePicker';
        break;
    case 'day':
        inputClass = 'dayOfWeek';
        break;

        case 'no':
        inputClass = 'no';
        break;
    default:
        inputClass = ''; // Default case if none of the above match
}

    

                // Create an input element and set its value to the current text
                var inputElement = $('<input>', {
             
                    type: inputType,
                    value: currentText,
                    name: tdName, // Set the name attribute based on the td's name
                    class:inputClass,
                    style: ' height: 30px; border: 1px solid #ccc; padding: 5px;' // Example styles



                });

                if (inputClass === 'no' || inputClass === 'dayOfWeek' ) {
                    inputElement.prop('readonly', true);
                }

                // Attach the change event using jQuery
if (inputClass === 'datePicker') {
    inputElement.change(function() {
        displayDayOfWeek(this); // Pass the current element to the function
    });
}


        
                // Empty the current td and append the input element
                $(this).empty().append(inputElement);
            }
        });

        // Refactor the displayDayOfWeek function
function displayDayOfWeek(datePickerElement) {
    const selectedDate = new Date(datePickerElement.value);

    // Use Arabic locale for the day of the week
    const options = { weekday: "long" };
    const dayOfWeek = selectedDate.toLocaleDateString("ar-SA", options);

    // Find the corresponding dayOfWeek input within the same row
    const dayOfWeekElement = $(datePickerElement).closest('tr').find('.dayOfWeek');

    if (dayOfWeekElement.length > 0) {
        dayOfWeekElement.val(` ${dayOfWeek}`);
    }
}
        
        $(this).closest('tr').find('[name="name"]').focus()
        $(this).closest('tr').find('.editable').show('fast')
        $(this).closest('tr').find('.noneditable').hide('fast')
    })

    // Delete Row
    $('.delete_data').click(function() {
        var id = $(this).closest('tr').attr('data-id')
        var name = $(this).closest('tr').find("[name='name']").text()
        var _conf = confirm("هل أنت متأكد انك تريد حذف السجل؟")
        if (_conf == true) {
            $.ajax({
                url: 'api.php?action=delete',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                error: err => {
                    alert("An error occured while saving the data")
                    console.log(err)
                },
                success: function(resp) {
                    if (resp.status == 'success') {
                        alert(name + 'تم حذفه بنجاح من القائمة.')
                        location.reload()
                    } else {
                        alert(resp.msg)
                        console.log(err)
                    }
                }
            })
        }
    })

    $('#form-data').submit(function(e) {
        e.preventDefault();
        var id = $('input[name="id"]').val()
        var data = {};
        // check fields promise
        var check_fields = new Promise(function(resolve, reject) {
                data['id'] = id;
                // $('td[contenteditable]').each(function() {
                    $('td input').each(function() {

                    // data[$(this).attr('name')] = $(this).text()

                    data[$(this).attr('name')] = $(this).val(); // Use .val() to get the input value



                    // if (data[$(this).attr('name')] == '') {
                    //     alert("All fields are required.");
                    //     resolve(false);
                    //     return false;
                    // }
                })
                resolve(true);
            })
            // continue only if all fields are filled
        check_fields.then(function(resp) {
            if (!resp)
                return false;
            // validate email
           
            $.ajax({
                url: "./api.php?action=save",
                method: 'POST',
                data: data,
                dataType: 'json',
                error: err => {
                    alert('An error occured while saving the data');
                    console.log(err)
                },
                success: function(resp) {
                    if (!!resp.status && resp.status == 'success') {
                        alert(resp.msg);
                        location.reload()
                    } else {
                        alert(resp.msg);
                    }
                }
            })
        })


    })
})


// removing table row when cancel button triggered clicked
window.cancel_button = function(_this) {
if (_this.closest('tr').attr('data-id') == '') {
    _this.closest('tr').remove()
} else {
    $('input[name="id"]').val('')
    _this.closest('tr').find('td').each(function() {
        // $(this).removeAttr('contenteditable')
        var input = $(this).find('input');
        var inputValue = input.val();
        // Remove the input element
         input.remove();
    
          // Set the text of the td to the value of the input
           $(this).text(inputValue);
    })
    _this.closest('tr').find('.editable').hide('fast')
    _this.closest('tr').find('.noneditable').show('fast')
}
}