$(document).ready(function() {

  $("#loading").ajaxStart(function(){
    $(this).show();
  });
  $("#loading").ajaxStop(function(){
    $(this).hide();
  });

  $('.alert_stub').live('click', function(){
    alert("Action not yet implemented. Are you shure all required modules are installed?");
  });
 
  $('.user-edit').live('click', function(){
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'administration/user_info/'+$(this).attr('id'),
            success:function(data){
            $('#modal-header-title').html('Edit');
            $('.modal-body').html(data);
            $('#myModal').modal('show');
            }
        });
  });

  $('.partner-name-edit').live('click', function(){
      var id = $(this).attr('id').replace('partner-','');
      var name = $('#myname').text();
      $(this).hide();
      $('#myname').html('<input type="text" value="'+name+'" id="to_update_name"/><a id="to_update_name_confirm" href="#" onclick="savePartnerName('+id+')"><i class="icon-hdd"></i></a>');
  });
  
  $('#address_kind').live('change',function(){
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'crm/address_switch/'+$(this).val(),
            success:function(data){
            $('#address-details').html(data);
            }
        });
    //alert('I have to change with '+$(this).val()+'...');
  });
  
  $('#address-save-submit').live('click',function(){
    $.ajax({
      type: 'POST',
      url: jQuery.data(document.body, 'base_url')+'crm/save_address',
      data: $("#address-details").serialize(),
      success: function(data){$('#address-save-result').html(data)}
    });
  });
  
  $('#new-contact').live('click', function(){
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'crm/contact_new/',
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('...');
            }
        });
  });
  
  $('.edit-contact').live('click', function(){
      var id = $(this).attr('id').replace('contact-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'crm/contact_new/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit');
            }
        });
  });  
  
  $('.add-quotation-row').live('click', function(){
      var id = $(this).attr('id').replace('contact-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/add_quotation_row/',
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Products');
            }
        });
  });
  
  
  $('.append-product').live('click', function(){
      var id = $(this).attr('id').replace('product-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/add_product_to_quotation/'+id,
            success:function(data){
            $('#'+$(this).attr('id')).after('*');
            $('#main-space').html(data);
            }
        });
  });
  
  
  $('#quote-approve-submit').live('click', function(){
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/approve_quotation/',
            success:function(data){
            $('#workflow-path').html(data);
            $('#quote-approve-submit').hide();
            }
        });
  });
  
  $('#quote-revoke-submit').live('click', function(){
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/revoke_quotation/',
            success:function(data){
            $('#workflow-path').html(data);
            $('#quote-revoke-submit').hide();
            }
        });
  });  
  
  $('.edit-quotation_row').live('click', function(){
    var id = $(this).attr('id').replace('quotation_row-','');
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/quotation_row_edit/'+id,
            success:function(data){
            $('#quotation_row-'+id).html(data);
            }
        });
  });  
  
  $('.save-quotation_row').live('click',function(){
    var id = $(this).attr('id').replace('quotation_row_edit-','');

    $.ajax({
      type: 'POST',
      url: jQuery.data(document.body, 'base_url')+'sales/quotation_row_save/'+id,
      data: $("#quotation_row-"+id+" .input-small").serialize(),
      success: function(data){
        alert(data);
        $('#quotation_row-'+id).html(data);
      }
    });
  }); 
  
  $('.add-purchase-row').live('click', function(){
      var id = $(this).attr('id').replace('purchase-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'projects/add_purchase_row/'+id,
            success:function(data){
            $('#my_temp_target').html(data);
            }
        });
  });
  
  $('.add-purchase-request-row').live('click', function(){
      var id = $(this).attr('id').replace('purchase-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'projects/add_purchase_request_row/'+id,
            success:function(data){
            $('#my_temp_target').html(data);
            }
        });
  });  
  
  $('#recalculate-quotation').live('click', function(){

      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/quotation_recalculate/',
            success:function(data){
            $('#quote_footer').html(data);
            }
        });
  });  
      
  $('.fillhead').live('keypress', function(){
    $('.modal-header').html($('#contact-name').val()+' '+$('#contact-second').val());
  });  
  
  $('#contact-save-submit').live('click',function(){
    $.ajax({
      type: 'POST',
      url: jQuery.data(document.body, 'base_url')+'crm/save_contact',
      data: $("#contact-details").serialize(),
      success: function(data){$('#contact-save-result').html(data);}
    });
  });  
  
  $('#quote-save-submit').live('click',function(){
    $.ajax({
      type: 'POST',
      url: jQuery.data(document.body, 'base_url')+'sales/save_quote',
      data: $("#quote-details").serialize(),
      success: function(data){
      /*
        if(data != 0){ res = 'saved'; }
        $('#quote-save-result').html('<span class="label label-success">'+data+'</span>');
        $('#adder-el').fadeIn();
        $('.add-quotation-row').attr('id','quotation-'+data);
      */
        window.location = jQuery.data(document.body, 'base_url')+'sales/show_quotation/'+data;
      }
    });
  });  
  
  
  $('.edit-workflow').live('click', function(){
      var id = $(this).attr('id').replace('workflow-','');
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'administration/workflow_new/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit');
            }
        });
  }); 
  
  $('#create_project_btn').live('click', function(){

      var id = $('.q-to-prj-el:checked').attr('id').replace('quotation-sel-','');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'projects/create/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Confirm project creation');
            }
      });
    
  });  
  
  $('#project_show_item').live('click', function(){

      var id = $(this).attr('name');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'projects/show_item/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit ('+id+')');
            }
      });
    
  }); 
    
  
  $('#new_purchase_btn').live('click', function(){

      var id = $(this).attr('name');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'purchases/new_purchase/',
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit ('+id+')');
            }
      });
    
  }); 
  
  $('#new_purchase_request_btn').live('click', function(){

      var id = $(this).attr('name');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'purchases/new_purchase_request/',
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit ('+id+')');
            }
      });
    
  }); 
  
  
   $('.purchase_show').live('click', function(){

      var id = $(this).attr('name');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'purchases/review_purchase/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Edit ('+id+')');
            }
      });
  });  
    
   $('.project_add_item').live('click', function(){
      var id = $(this).attr('name');
    
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'projects/add_item/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Add item ('+id+')');
            }
      });
  });
  
    
  $('#purchase-request-details').live('submit',function(){
    $.ajax({
            type: 'POST',
            url: jQuery.data(document.body, 'base_url')+'purchases/save_purchase_request/',
            data: $("#purchase-request-details").serialize(),
            success: function(data){
                  $('.modal-body').html(data);
                  $('.modal-header').html('Edit - saved');
                }
        });
  });
  
  $('#purchase-details').live('submit',function(){
    $.ajax({
            type: 'POST',
            url: jQuery.data(document.body, 'base_url')+'purchases/save_purchase/',
            data: $("#purchase-details").serialize(),
            success: function(data){
                  $('.modal-body').html(data);
                  $('.modal-header').html('Edit - saved');
                }
        });
  });  
  
  $('.bindReqToQuote').live('click', function(){
    var id = $(this).attr('name');
    $(this).parent().parent().css({'color':'red'});
    $(this).hide();
    
    $.ajax({
        type:'GET',
        url: jQuery.data(document.body, 'base_url')+'sales/bind_req_to_quote/'+id,
        success:function(data){

        }
      });
  });
  
  $('.show_quotereq').live('click', function(){
  
        var id = $(this).attr('name');
      
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'sales/quotationreq_show/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Edit ('+id+')');
              }
        });
      
  });  
  
  $('.add-el-to-purchase').live('click', function(){
  
        var id = $(this).attr('name');
      
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'purchases/add_el_to_purchase/'+id,
              success:function(data){
              $('#agile-table').append(data);
              }
        });

        $(this).hide();
        $(this).parent().parent().fadeTo('slow', 0.5);      
      
  });
  
  $('.add-el-to-purchase-request').live('click', function(){
  
        var id = $(this).attr('name');
      
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'purchases/add_el_to_purchase_request/'+id,
              success:function(data){
              $('#agile-table').append(data);
              }
        });

        $(this).hide();
        $(this).parent().parent().fadeTo('slow', 0.5);      
      
  });    
   
  $('#purchase_item_show').live('click', function(){

        var id = $(this).attr('name');
      
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'purchases/edit_row/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Edit ('+id+')');
              }
        });   
      
  });  
  
  $('#new-product').live('click', function(){
      
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'sales/new_product/',
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Create new product');
              }
        });   
      
  });  
  
  $('#edit-product').live('click', function(){
        var id = $(this).attr('name');
              
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'sales/edit_product/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Edit product');
              }
        });   
      
  });   
  
  
  $('#project_delete_item').live('click', function(){
        var id = $(this).attr('name');
              
        $.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'projects/delete_item/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Delete item');
              }
        });   
      
  });
  
  
  $('#quotation_delete_item').live('click', function(){
      var id = $(this).attr('name');
            
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/delete_item/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Delete item');
            }
      });   
    
});  
  
  $('#partner_delete').live('click', function(){
      var id = $(this).attr('name');
            
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'crm/delete_partner/'+id,
            success:function(data){
            $('.modal-body').html(data);
            $('.modal-header').html('Delete partner');
            }
      });   
    
});
  
  
  $('.delete-product').live('click', function(){
      var id = $(this).attr('name');
            
      $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'sales/delete_product/'+id,
            success:function(data){
            	$('#pr-'+id).addClass('deleted-row');
            }
      });   
    
});  
  

  $('.delete-attachment').live('click', function(){
      var id = $(this).attr('name');
      var el = $(this).attr('id');
      var answer = confirm("Confirm to delete attachment ID:"+id+"?")
      if (answer){
			alert("Element deleted!")
			$.ajax({
            	type:'GET',
            	url: jQuery.data(document.body, 'base_url')+'attachment/delete_attachment/'+id,
            	success:function(data){
	            	$('#'+el).parent().parent().hide();
	            }
	         });   

	  }else{
			alert("No elements deleted!")
	  }
	    
});  
    
  $('#product-details').live('submit',function(){
    $.ajax({
      type: 'POST',
      url: jQuery.data(document.body, 'base_url')+'sales/save_product',
      data: $("#product-details").serialize(),
      success: function(data){$('.modal-body').html(data);}
    });
  });
    
    
    
    $('.invoice-term-submit').live('click',function(){
    	var id = $(this).attr('name');
    	
        $.ajax({
          type: 'POST',
          url: jQuery.data(document.body, 'base_url')+'account/update_term',
          data: $('#term-'+id).serialize(),
          success: function(data){
        	  $(this).fadeOut();
          }
        });
      });    
    
	$('#taxes').live('blur', function(){
		calcUntaxed();
	});

	$('#amount').live('blur', function(){
		calcUntaxed();
	});

	$('#amount_untaxed').live('blur', function(){
		calcUntaxed();
	});
	
	$('#transfer').live('blur', function(){
		calcUntaxed();
	});

  $('#transport').live('blur', function(){
    calcUntaxed();
  });

	$('.users_add').live('click', function(){
		$.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'administration/user_form/',
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Add new user');
              }
        }); 
	});
	
	$('#send_invoice_mail').live('click', function(){
		var id = $(this).attr('name');
		
		$.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'account/send_invoice_mail/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Send invoice via e-mail');
              }
        }); 
	});
	
	$('.update_password').live('click', function(){
		$.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'administration/update_password_form/',
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Update your password');
              }
        }); 
	});
	
	
	$('.purchase_request_item_show').live('click', function(){
		var id = $(this).attr('name');
		
		$.ajax({
              type:'GET',
              url: jQuery.data(document.body, 'base_url')+'purchases/edit_purchase_request/'+id,
              success:function(data){
              $('.modal-body').html(data);
              $('.modal-header').html('Update purchase request item');
              }
        }); 
	});
	
	
	$('#purchase_request_item_edit_submit').live('click',function(){
		var id = $("#purchase_request_item_edit").attr('name');
	
	    $.ajax({
	      type: 'POST',
	      url: jQuery.data(document.body, 'base_url')+'purchases/edit_purchase_request_save/'+id,
	      data: $("#purchase_request_item_edit").serialize(),
	      success: function(data){$('.modal-body').html(data);}
	    });
    });
		
	$('.group-toggler').live('change',function(){
	
		var gid = $(this).attr('name');
		var uid = $(this).attr('title');		
	
		$.ajax({
        	type:'GET',
        	url: jQuery.data(document.body, 'base_url')+'administration/update_user_group/'+uid+'/'+gid,
        	success:function(data){
            	$('#group-'+gid).parent().hide();
            }
         });
	});
	
	$('.permission-delete').live('click',function(){
		var id = $(this).attr('name');
	
		$.ajax({
        	type:'GET',
        	url: jQuery.data(document.body, 'base_url')+'administration/delete_rule/'+id,
        	success:function(data){
            	$(this).parent().parent().hide();
            }
         });
	});	
	
	$('.edit-in-row').live('click', function(){
		
		field = $(this).attr('data-fieldname');
	
		t = $(this).attr('rel');
		id = $(this).attr('name');
		
		val = $(this).text();
		
		$(this).html('<input type="text" value="'+val+'" name="'+field+'" title="'+id+'" rel="'+t+'"/>');
		$(this).children().focus();
		
	});

  $('.prj-info-tab td.clickable').toggle(function(){
    $(this).css('background-color','#9DE2ED');
  }, function(){
    $(this).css('background-color','transparent');
  });
	
	$('.edit-in-row input').live('blur', function(){         
         
       	$.ajax({
	      type: 'POST',
	      url: jQuery.data(document.body, 'base_url')+'actions/fast_update/'+$(this).attr('rel')+'/'+id,
	      data: $(this).serialize(),
	      success: function(data){
	        	$(this).parent().html($(this).val());		
            	$(this).remove();
	      }
	    });

		
	});	
	      
	
	
	$('.search-query').live('keyup', function(){
		table = $(this).attr('data-table');
		field = $(this).attr('data-field');
		val = $(this).val();
		
		$.ajax({
        	type:'GET',
        	url: jQuery.data(document.body, 'base_url')+table+"/fast_query/"+field+"/"+val,
        	success:function(data){
        		$('#'+table+'-browser').html(data);
            }
         });
		
	});

  $('#purchase_item_split').live('click', function(){
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'purchases/purchase_item_split/'+$(this).attr('name'),
            success:function(data){
            $('#modal-header-title').html('Split purchase item');
            $('.modal-body').html(data);
            $('#myModal').modal('show');
            }
        });
  });

  $('#do_split_row').live('click', function(){
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'purchases/do_purchase_item_split/'+$('#item-to-split')+'/'+$('#split-item'),
            success:function(data){
            $('#modal-header-title').html('Split purchase item');
            $('.modal-body').html('item splitted');
            // $('#myModal').modal('show');
            }
        });
  });

});

$(function(){
      window.prettyPrint && prettyPrint();
      $('#project-estimated_close_date').datepicker({
        format: 'dd-mm-yyyy'
      });
      
      $('.datefield').datepicker({
        format: 'dd-mm-yyyy'
      });
      
      $('a[rel=tooltip]').tooltip();

});


function savePartnerName(id){
    var name = $('#to_update_name').val();
    $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'crm/update_partner_name/'+id+'/'+name,
            success:function(data){
            $('#to_update_name').remove();
            $('#to_update_name_confirm').remove();
            $('#myname').html(data);
            $('#partner-'+id).show();
            }
        });
}

function liveToggle(style){
  $('.'+style).toggle();
}

function fastUpdateWf(n,table,id){
  $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'actions/fastUpdateWf/'+table+'/'+n+'/'+id,
            success:function(data){
              $('.wfactive').removeClass('badge badge-info');
                $('.wfactive').removeClass('wfactive');
              $('#wf-'+n).addClass('badge badge-info wfactive');
            }
        });
}

function calcUntaxed(){
	taxes = $('#taxes').val();
	amount_untaxed = $('#amount_untaxed').val();
	transfer = $('#transfer').val();
	transport = $('#transport').val();

	amount_untaxed = amount_untaxed - transfer;

  if (transport == ''){
	 transport = 0;
	}

  res = parseFloat(transport) + parseFloat(amount_untaxed) + (parseFloat(amount_untaxed)+parseFloat(transport))/100*taxes;
	res = Math.round(res*100)/100 
	
	$('#amount').val(res);
}


function updatePassword(id,pass){
	  $.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'administration/update_password/'+id+'/'+pass,
            success:function(data){
	            $('#updateRes').html(data);
            }
        });
}
