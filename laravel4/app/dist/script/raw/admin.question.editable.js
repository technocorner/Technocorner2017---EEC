$(document).ready(function(){
    // No intent to create new type?
    if ($('#qtype')[0].selectedIndex != 0) {
        $('#qtype-new').hide();
        $('#qtype-new').prop('required', false);
    }

    $('#qtype').change(function (e) {
        if (this.selectedIndex == 0) {
            $('#qtype-new').show();
            $('#qtype-new').prop('required', true);
        } else {
            $('#qtype-new').hide();
            $('#qtype-new').prop('required', false);
        }
    });
});
