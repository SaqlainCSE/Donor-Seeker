$(document).ready(function(){
	/* For Dynamic District DropDown */
	$("#division").on('change' , function(){
		var divisionId = $(this).val();
		$.ajax({
			method:"POST",
			url:"ajax.php",
			data:{id:divisionId},
			dataType:"html",
			success:function(data){
				$("#district").html(data);
			}
		});
	});
	/* For Dynamic Sub-District DropDown */
	$("#district").on('change' , function(){
    var districtId = $(this).val();
    $.ajax({
      method:"POST",
      url:"ajax.php",
      data:{districtId:districtId},
      dataType:"html",
      success:function(data){
        $("#sub_district").html(data);
      }
    });
  });
	/* For Dynamic Area/Village DropDown */
	$("#sub_district").on('change' , function(){
    var sub_districtId = $(this).val();
    $.ajax({
      method:"POST",
      url:"ajax.php",
      data:{sub_districtId:sub_districtId},
      dataType:"html",
      success:function(data){
        $("#village").html(data);
      }
    });
  }); 

});