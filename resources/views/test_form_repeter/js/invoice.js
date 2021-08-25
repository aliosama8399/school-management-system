
  let count = 1;
  // Add new row in the table to add new multible privileges
  $(document).on('click','#add_row',function(){
    count++;
    let html_code = '';
    html_code = '<tr id="invoice_row_'+count+'"><td><span id="sr_no'+count+'">'+count+'</span></td>';
    html_code +='<td><input type = "text" name = "product[]" title="" id="product'+count+'" class = "form-control product" required ></td>';
    html_code +='<td><input type = "text" name = "quantity[]" id = "quantity'+count+'" class = "form-control input-sm quantity" required></td>';
    html_code +='<td><input type = "text" name = "price[]" id="price'+count+'" class = "form-control input-sm price" required readonly></td>';
    html_code +='<td><input type = "text" name = "total[]" id="total'+count+'" readonly class = "form-control input-sm total" required ></td>';
    html_code +='<td><button type="button" id="'+count+'" class="btn btn-danger btn-xs remove_row"><i class="fa fa-times"></i></button></td></tr>';

    $('#total_item').val(count);
    $("#invoice-item-table").append(html_code);

  });

  $(document).on('click','.remove_row', function(){
    count--;
    let row_id = $(this).attr('id');
    $('#total_item').val(count);
    $('#invoice_row_'+row_id).remove();
    
  }); // End Clicked of remove_row class
  
  // auto complate search
  $(document).on('blur', '.product', function(){

    let product = $(this).val();

  });

  function cal_final_total(count)
  {
    let final_total = 0;
    let final_debit = 0;
    let final_craidator = 0;
  
    for(j = 1; j <= count; j++)
    {  

      let quantity = 0;
      let price = 0;
      let total_invoice_price = 0;
      let debit = 0;
      let craidator = 0;

      quantity = $('#quantity'+j).val();
  
      if(quantity > 0){
  
        price = $('#price'+j).val();
  
        if(price > 0){
  
          total_invoice_price = parseFloat(quantity) * parseFloat(price);
  
          $('#total'+j).val(total_invoice_price);
  
          craidator = $('#craidator'+j).val();
  
          if(craidator > 0){
  
            debit = parseFloat(total_invoice_price) - parseFloat(craidator);
            
            $('#debit'+j).val(debit);
            final_craidator = parseFloat(craidator) + final_craidator;
            final_debit = parseFloat(final_debit) + parseFloat(debit);

          } // End craidator
  
          final_total = parseFloat(final_total) + parseFloat(total_invoice_price);
          // $('#amount'+j).val(item_total);
  
        } // End check if price

      } // End if quantity

    } // End for loop
  
    $('#final_total_amt').text(final_total);
    $('#final_craidator').text(final_craidator);
    $('#final_debit').text(final_debit);
  
  } // End function cal_final_total
  
  $(document).on('blur','.price',function(){
    cal_final_total(count);
  });
  
  $(document).on('blur','.quantity',function(){
    cal_final_total(count);
  });
  
  
  $('#create_invoice').click(function(){
  
    if($.trim($('#date').val()).length == 0){
      alert('حدد تاريخ الفاتورة');
      return false;
    }
  
    if($.trim($('#client_name').val()).length == 0){
      alert('الرجاء إدخال أسم العميل');
      return false;
    }
  
    if($.trim($('#check_no').val()).length == 0){
      alert('أدخل رقم شيك الضمان');
      return false;
    }
  
    if($.trim($('#check_owner').val()).length == 0){
      alert('الرجاء إدخال أسم صاحب الشيك');
      return false;
    }
  
  
    for(let no=1; no<=count;no++){
  
      if($.trim($('#product'+no).val()).length == 0){
        alert('أدخل المنتج المراد بيعه');
        $('#product'+no).focus();
        return false;
      }
  
      if($.trim($('#quantity'+no).val()).length == 0){
        alert('أدخل الكمية');
        $('#quantity'+no).focus();
        return false;
      }
  
      if($.trim($('#price'+no).val()).length == 0){
        alert('أدخل السعر');
        $('#price'+no).focus();
        return false;
      }

      if($.trim($('#craidator'+no).val()).length == 0){
        alert('أدخل المبلغ الذي سيتم دفعه');
        $('#craidator'+no).focus();
        return false;
      }

      if($.trim($('#amount_literally'+no).val()).length == 0){
        alert('أدخل المبلغ بالحروف');
        $('#amount_literally'+no).focus();
        return false;
      }

    }
  
    $('#invoice_form').submit();
  
  }); // End Clicked the id create_invoice  

