$(document).ready(function(){

    var required_inputs = {};

    var count = $("#tab-count").val();

    var current_tab = 0;

    var percentage = (1*100)/count;



    var progress_bar = '<div class="progress" style="margin-bottom:18px">\n' +
        '  <div class="progress-bar" role="progressbar" aria-valuenow="70"\n' +
        '  aria-valuemin="0" aria-valuemax="100" style="width:'+percentage+'%">\n' +
        '    <span class="sr-only">'+percentage+'% Complete</span>\n' +
        '  </div>\n' +
        '</div>';

    if(count > 1){
        $(".form-wizard-holder").prepend('<div style="text-align: center"><span class="form-counter" style="font-size: 19pt">Step 1 of ' + count + '</span>'+progress_bar+'</div>')
    }


    for(i = 1; i < count; i++){
        $(".tab-" + i).hide();
    }

    remove_requires();

    $("#prev-form-tab").hide();

    $("#next-form-tab").on('click',function(){

        if(validate_tab(current_tab)){
            $(".tab-" + current_tab).hide();
            current_tab++;
            $(".tab-" + current_tab).show();

            toggleNextBack(current_tab);
        }
    });

    $("#prev-form-tab").on('click',function(){
        $(".tab-" + current_tab).hide();
        current_tab--;
        $(".tab-" + current_tab).show();
        toggleNextBack(current_tab);
    });

    toggleNextBack(0);

    function toggleNextBack(current_tab){
        if(current_tab > 0){
            $("#prev-form-tab").show();
        }else{
            $("#prev-form-tab").hide();
        }

        if(current_tab > (count-2)){
            $("#next-form-tab").hide();
            $("#submit-form").show();
        }else{
            $("#next-form-tab").show();
            $("#submit-form").hide();
        }

        var i = current_tab + 1;

        $(".form-counter").html('Step ' + i +' of ' + count);

        percentage = (i*100)/count;

        $(".progress-bar").css('width', percentage+"%");

    }

    function validate_tab(tab){
        var ret = true

        $(".tab-"+tab+" input").each(function(){
            var input_name = $(this).attr('name');
            if(required_inputs[input_name]){
                $(this).attr('required','');
            }
            var value = $(this).val();
            value = value.trim();
            if($(this).attr("required") && value.length == 0){
                ret = false;
                $("#submit-form-real").click();
            }
        });
        return ret;
    }

    /*$("#submit-form-real").on('click',function(e){
        e.preventDefault();
        alert(7);
        /!*var html = '<div class="alert alert-success" role="alert">\n' +
            '      <strong>Well done!</strong> You successfully submitted the form.\n' +
            '    </div>';
        $(".form-wizard-holder").html(html);*!/
    });*/


    function remove_requires(){
        $('input[required]').each(function () {
            required_inputs[$(this).attr('name')] = 1;
            $(this).removeAttr('required');
        });
    }

    $(".form-wizard-holder").show();

    $("#submit-form").on('click',function(e){
        if(validate_tab(current_tab)){
            remove_requires();
            $("#submit-form-real").click();
        }
    });


    var state_list = {
        "0":"",
        "AL": "Alabama",
        "AK": "Alaska",
        "AS": "American Samoa",
        "AZ": "Arizona",
        "AR": "Arkansas",
        "CA": "California",
        "CO": "Colorado",
        "CT": "Connecticut",
        "DE": "Delaware",
        "DC": "District Of Columbia",
        "FM": "Federated States Of Micronesia",
        "FL": "Florida",
        "GA": "Georgia",
        "GU": "Guam",
        "HI": "Hawaii",
        "ID": "Idaho",
        "IL": "Illinois",
        "IN": "Indiana",
        "IA": "Iowa",
        "KS": "Kansas",
        "KY": "Kentucky",
        "LA": "Louisiana",
        "ME": "Maine",
        "MH": "Marshall Islands",
        "MD": "Maryland",
        "MA": "Massachusetts",
        "MI": "Michigan",
        "MN": "Minnesota",
        "MS": "Mississippi",
        "MO": "Missouri",
        "MT": "Montana",
        "NE": "Nebraska",
        "NV": "Nevada",
        "NH": "New Hampshire",
        "NJ": "New Jersey",
        "NM": "New Mexico",
        "NY": "New York",
        "NC": "North Carolina",
        "ND": "North Dakota",
        "MP": "Northern Mariana Islands",
        "OH": "Ohio",
        "OK": "Oklahoma",
        "OR": "Oregon",
        "PW": "Palau",
        "PA": "Pennsylvania",
        "PR": "Puerto Rico",
        "RI": "Rhode Island",
        "SC": "South Carolina",
        "SD": "South Dakota",
        "TN": "Tennessee",
        "TX": "Texas",
        "UT": "Utah",
        "VT": "Vermont",
        "VI": "Virgin Islands",
        "VA": "Virginia",
        "WA": "Washington",
        "WV": "West Virginia",
        "WI": "Wisconsin",
        "WY": "Wyoming"
    };

    var state_option = '';

    $.each(state_list, function(i,v){
        state_option += '<option value="' + v + '">' + v + '</option>';
    });

    if(state_option.length > 0){
        $(".append-state").html(state_option);
    }

});
