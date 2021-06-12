$(document).ready(function ()
{
    $('#date').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });
    $('#date1').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });
    $('#dateOfBirth').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });

    $('#therapyDate').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });

    $('#time').bootstrapMaterialDatePicker
            ({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });
    $('#time2').bootstrapMaterialDatePicker
            ({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });

    $('#date-format').bootstrapMaterialDatePicker
            ({
                format: 'dddd DD MMMM YYYY - HH:mm'
            });
    $('#date-fr').bootstrapMaterialDatePicker
            ({
                format: 'DD/MM/YYYY HH:mm',
                lang: 'fr',
                weekStart: 1,
                cancelText: 'ANNULER',
                nowButton: true,
                switchOnClick: true
            });

    $('#date-end').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'YYYY-MM-DD HH:mm:ss'
            });
    $('#date-start').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'YYYY-MM-DD HH:mm:ss'
            }).on('change', function (e, date)
    {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
    });

    /******************For feedback**********************/
    $('#date-end1').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'YYYY-MM-DD HH:mm:ss'
            });
    $('#date-start1').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'YYYY-MM-DD HH:mm:ss'
            }).on('change', function (e, date)
    {
        $('#date-end1').bootstrapMaterialDatePicker('setMinDate', date);
    });
    /***************************************/

    $('#min-date').bootstrapMaterialDatePicker({format: 'YYYY-MM-DD HH:mm:ss', minDate: new Date()});


});