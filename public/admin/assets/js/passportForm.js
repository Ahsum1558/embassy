$(document).ready(function(){
    $('#select').change(function() {
        var countryId = $(this).val();
        if(countryId){
            $('#overlay .loader').show();
            $.get("{{ route('admin.customer.getDivision') }}", {country_id:countryId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#single-select').empty().html(data);
            });
        }else{
            $('#single-select').empty().html('<option value="">Select Division</option>');
        }
    });

    $('#single-select').change(function() {
        var divisionId = $(this).val();
        var countryId = $('#select').val();
        if(divisionId && countryId){
            $('#overlay .loader').show();
            $.get("{{ route('admin.customer.getDistrict') }}", {division_id:divisionId, country_id:countryId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#id_label_single').empty().html(data);
            });
        }else{
            $('#id_label_single').empty().html('<option value="">Select District</option>');
        }
    });

    $('#id_label_single').change(function() {
        var districtId = $(this).val();
        var divisionId = $('#single-select').val();
        var countryId = $('#select').val();
        if(districtId && divisionId && countryId){
            $('#overlay .loader').show();
            $.get("{{ route('admin.customer.getUpzila') }}", {district_id:districtId, division_id:divisionId, country_id:countryId}, function(data){
                $('#overlay .loader').hide();
                console.log(data);
                $('#upzilaselect').empty().html(data);
            });
        }else{
            $('#upzilaselect').empty().html('<option value="">Select Police Station</option>');
        }
    });

});