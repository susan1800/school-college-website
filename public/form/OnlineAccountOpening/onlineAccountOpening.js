if (!window.app) {
    window.app = {};
};



app.onlineAccountOpening = (function () {

    var mainBody = $('#onlineAccountOPening'),
        dataSource = app.dataSourceonlineAccountOpening,
        init = function () {
            mainBody.find('#onlineAccountOPeningForm').on('click', '.ContinueForm', validateForm);
            mainBody.find('#onlineAccountOPeningForm').on('change', '.IsCorrespondenceAddress', IsCorrespondenceAddress);
            mainBody.find('#onlineAccountOPeningForm').on('click', '.previewDocument', previewDocument);
            mainBody.find('#onlineAccountOPeningForm').on('click', '.finalFormSubmition', submitForm);
            mainBody.find('#onlineAccountOPeningForm').on('change', '#MaritalStatus', displaySpouseInformation);
            mainBody.find('#onlineAccountOPeningForm').on('change', '.SelectIDType', IdTypeChange);
            mainBody.find('#onlineAccountOPeningForm .ValidTill').hide();
            mainBody.find('#onlineAccountOPeningForm').on('change', '.fileupload', checkValidationFile);
            //mainBody.find('#onlineAccountOPeningForm').on('change', '.IsConvicted', IsConvicted);
        },
        IdTypeChange = function (event) {
            event.preventDefault();
            
            var idtype = mainBody.find('#onlineAccountOPeningForm').find('.SelectIDType').select().val();
            if (idtype === 'Citizenship') {
                mainBody.find('#onlineAccountOPeningForm .ValidTill').hide();
            } else {
                mainBody.find('#onlineAccountOPeningForm .ValidTill').show();
            }
        },
        validateForm = function (event) {
            event.preventDefault();

            $.validator.unobtrusive.parse('#onlineAccountOPeningForm');

            if (mainBody.find('#onlineAccountOPeningForm').valid()) {

                $(this).parents(".step-from-single").addClass("done-step");
                $(this).parents(".step-from-single").removeClass("undone-step");
                $(this).parents(".step-from-single").hide();
                $(".step-form-wrapper").find('.done-step').next().show();
                $(".step-form-wrapper").find('.done-step').hide();
                var navStepSelector = $(this).parents(".step-from-single").attr('data-toggle');
                $('.step-toggle[data-toggle = ' + navStepSelector + ']').addClass('step-nav-visited');
                $(".step-nav-visited").parents('li').next("li").find('.step-toggle').addClass("step-nav-current step-identity");
                $(".step-nav-visited").removeClass("step-nav-current");
                $("html, body").animate({ scrollTop: 20 });

            } else {
                return false;
            }
        },
        //IsMemeber = function (event) {
        //    event.preventDefault();
        //    if ($(this).val() === "Yes") {

        //        mainBody.find('#IsConvictedHidden').val(true);

        //    } else {

        //        mainBody.find('#IsConvictedHidden').val(false);

        //    }

        //},
        //IsConvicted = function (event) {
        //    event.preventDefault();
        //    if ($(this).val() === "Yes") {

        //        mainBody.find('#IsConvictedHidden').val(true);

        //    } else {

        //        mainBody.find('#IsConvictedHidden').val(false);

        //    }

        //},
        IsCorrespondenceAddress = function (event) {
            event.preventDefault();

            if ($(this).val() === "Yes") {

                applySameAddress();

            } else {

                removeSameAddress();

            }

        },
        applySameAddress = function () {

            var Country = mainBody.find('.ResidentialCountry').val();
            var State = mainBody.find('.ResidentialState').val();
            var District = mainBody.find('.ResidentialDistrict').val();
            var Town = mainBody.find('.ResidentialTown').val();
            var WardNumber = mainBody.find('.ResidentialWardNumber').val();
            var Address = mainBody.find('.ResidentialAddress').val();

            mainBody.find('.CorrespondenceCountry').val(Country);
            mainBody.find('.CorrespondenceState').val(State);
            mainBody.find('.CorrespondenceDistrict').val(District);
            mainBody.find('.CorrespondenceTown').val(Town);
            mainBody.find('.CorrespondenceWardNumber').val(WardNumber);
            mainBody.find('.CorrespondenceAddress').val(Address);

            mainBody.find('.PermanentCountry').val(Country);
            mainBody.find('.PermanentState').val(State);
            mainBody.find('.PermanentDistrict').val(District);
            mainBody.find('.PermanentTown').val(Town);
            mainBody.find('.PermanentWardNumber').val(WardNumber);
            mainBody.find('.PermanentAddress').val(Address);

        },
        removeSameAddress = function () {

            var Country = mainBody.find('.ResidentialCountry').val();
            var State = mainBody.find('.ResidentialState').val();
            var District = mainBody.find('.ResidentialDistrict').val();
            var Town = mainBody.find('.ResidentialTown').val();
            var WardNumber = mainBody.find('.ResidentialWardNumber').val();
            var Address = mainBody.find('.ResidentialAddress').val();

            mainBody.find('.CorrespondenceCountry').val(Country);
            mainBody.find('.CorrespondenceState').val(null);
            mainBody.find('.CorrespondenceDistrict').val(null);
            mainBody.find('.CorrespondenceTown').val(null);
            mainBody.find('.CorrespondenceWardNumber').val(null);
            mainBody.find('.CorrespondenceAddress').val(null);

            mainBody.find('.PermanentCountry').val(Country);
            mainBody.find('.PermanentState').val(null);
            mainBody.find('.PermanentDistrict').val(null);
            mainBody.find('.PermanentTown').val(null);
            mainBody.find('.PermanentWardNumber').val(null);
            mainBody.find('.PermanentAddress').val(null);

        },
        previewDocument = function (event) {
            event.preventDefault();

            var $form = mainBody.find('#onlineAccountOPeningForm');

            

            var serviceType = "";
            $('#ServiceType').val('');

            $('input[name=ServiceTypeCheckBox]').each(function () {
                if (this.checked) {

                    serviceType = serviceType + $(this).val() + ",";

                    $('#ServiceType').val(serviceType);
                }
            });

            dataSource.previewForm($form).done(function (response) {
                $('body').find('#previewModal .modal-body').html(response);
                $('body').find('#previewModal .modal-dialog').addClass("modal-xl");
                $('body').find('#previewModal').modal({ backdrop: 'static', keyboard: false });
                $('body').find('#previewModal').modal('show');

            }).fail(function () {


            });


        },
        submitForm = function (event) {

            event.preventDefault();
            if (mainBody.find('#onlineAccountOPeningForm').valid()) {

                var serviceType = "";
                $('#ServiceType').val(null);

                $('input[name=ServiceTypeCheckBox]').each(function () {
                    if (this.checked) {

                        serviceType = serviceType + $(this).val() + ",";

                        $('#ServiceType').val(serviceType);
                    }
                });

                

                //$('#IsConvictedHidden').val('false');

                //$('input[name=IsConvicted]').each(function () {
                //    if ($(this).val() === "Yes") {

                //        mainBody.find('#IsConvictedHidden').val('true');

                //    }
                //});

                //$('#IsMemberHidden').val('false');

                //$('input[name=IsMember]').each(function () {
                //    if ($(this).val() === "Yes") {
                        
                //        $('#IsMemberHidden').val('true');
                //    }
                //});

                if ($('#IsCorrespondenceAddress').prop('checked')) {

                    applySameAddress();
                }

                mainBody.find('#onlineAccountOPeningForm').submit();
            }

        },displaySpouseInformation = function (event) {
            event.preventDefault();

            if ($(this).val() === "Married") {
                $('#SpouseFullName').val(null);
                $('#FatherinlawFullName').val(null);
                $('.displaybySpouse').show();

            } else {
                $('#SpouseFullName').val(null);
                $('#FatherinlawFullName').val(null);
                $('.displaybySpouse').hide();
            }


        },
        checkValidationFile = function (event) {

            $(this).valid();

        };

    return {

        init: init
    };


}(jQuery));


jQuery(app.onlineAccountOpening.init);