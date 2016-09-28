/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('#addState').click(function () {
        var stateName = $('.addState #state').val();
        if (stateName !== null || typeof stateName != 'undefined') {
            $.ajax({
                url: 'function.php',
                type: 'POST',
                dataType: 'json',
                data: {state: stateName, function: 'addState'},
                success: function (response) {
                    $('.addState #state').val('');
                    getStates();
                    alert(response.msg);
                }
            });
        }
    });

    function getStates() {
        $.ajax({
            url: 'function.php',
            type: 'POST',
            dataType: 'json',
            data: {function: 'getState'},
            success: function (data) {
                var option = '';
                $.each(data, function (i, item) {
                    var value = item.state;
                    option += '<option value="' + value + '">' + value.toUpperCase() + '</option>';
                });
                $('.addDistrict #stateDropdown').empty().append(option);
            }
        });
    }

    $('#addDistrict').click(function () {
        var stateName = $('.addDistrict #stateDropdown').find(':selected').val();
        var districtName  = $('.addDistrict #district').val();
        if (stateName !== null || typeof stateName != 'undefined' || districtName != null || typeof districtName != 'undefined') {
            $.ajax({
                url: 'function.php',
                type: 'POST',
                dataType: 'json',
                data: {state: stateName,district:districtName, function: 'addDistrict'},
                success: function (response) {
                    $('.addDistrict #district').val('');
                    getStates();
                    alert(response.msg);
                }
            });
        }
    });
});
