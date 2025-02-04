<?php view('partials/header') ?>

<div id="viewport">
    <?php view('partials/sidebar') ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <!-- task back button -->
                <div class="create_button my-4">
                    <a href="<?php url('/') ?>" class="btn btn-primary btn-icon-split">
                        <span class="text">Back</span>
                    </a>
                </div>


                <div class="create_form">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Create Report</h4>
                        </div>


                        <div class="card-body">

                            <!-- Notification message show -->
                            <div class="row">
                                <div class="col-md-12 alert notify" style="display: none;"></div>
                            </div>

                            <form id="submissionForm">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="amount">Amount<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="amount" name="amount" placeholder="Enter amount">
                                        </div>

                                        <div class="form-group">
                                            <label for="buyer">Buyer<span class="text-danger">*</span></label>
                                            <input type="text" id="buyer" name="buyer" class="form-control" placeholder="Write buyer name">
                                        </div>

                                        <div class="form-group">
                                            <label for="receipt_id">Receipt ID<span class="text-danger">*</span></label>
                                            <input type="text" id="receipt_id" name="receipt_id" class="form-control" placeholder="Write receipt id">
                                        </div>

                                        <div class="form-group">
                                            <label for="buyer_email">Buyer email<span class="text-danger">*</span></label>
                                            <input type="email" id="buyer_email" name="buyer_email" class="form-control" placeholder="Write buyer email">
                                        </div>

                                        <div class="form-group add_item_parent">
                                            <label for="items">Item<span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <input type="text" name="items[]" class="form-control item-input" placeholder="Write item name">
                                                <button type="button" class="btn btn-sm btn-primary" id="add_item" style="width: 10%;">add +</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <label for="city">City<span class="text-danger">*</span></label>
                                            <input type="text" id="city" name="city" class="form-control" placeholder="Write city name">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone<span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Write phone number">
                                        </div>

                                        <div class="form-group">
                                            <label for="entry_by">Entry By<span class="text-danger">*</span></label>
                                            <input type="text" id="entry_by" name="entry_by" class="form-control" placeholder="Entry by">
                                        </div>

                                        <div class="form-group">
                                            <label for="note">Note<span class="text-danger">*</span></label>
                                            <textarea id="note" name="note" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-info" id="submit_btn" type="button">Save</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


<script src="<?php asset('js/jquery-3.7.0.min.js'); ?>"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const fields = ["amount", "buyer", "receipt_id", "buyer_email", "note", "city", "phone", "entry_by"];

        // Generic message functin
        function show_error_message(errorMessage, errorSpan, input) {
            if (errorMessage) {
                errorSpan.textContent = errorMessage;
                errorSpan.style.display = "block";
                input.style.border = "1px solid red";
            } else {
                errorSpan.style.display = "none";
                input.style.border = "1px solid #ddd";
            }
        }


        // Every field validation check
        fields.forEach(field => {
            let input = document.querySelector("#" + field);
            let errorSpan = document.createElement("span");
            errorSpan.style.color = "red";
            errorSpan.style.display = "none";
            input.parentNode.appendChild(errorSpan);

            let timer;
            input.addEventListener("keyup", function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    validateField(input, errorSpan);
                }, 2000);
            });
        });

        function validateField(input, errorSpan) {
            let value = input.value.trim();
            let id = input.id;
            let errorMessage = "";

            if (value === "") {
                errorMessage = "Should not empty";
            } else {
                if (id === "amount" && !/^[0-9]+$/.test(value)) {
                    errorMessage = "Amount must be a number";
                } else if (id === "buyer" && !/^[a-zA-Z0-9 ]{1,20}$/.test(value)) {
                    errorMessage = "Buyer name must be up to 20 characters, letters, numbers, and spaces only";
                } else if (id === "receipt_id" && !/^[a-zA-Z]+$/.test(value)) {
                    errorMessage = "Receipt ID must be letters";
                } else if (id === "buyer_email" && !/^\S+@\S+\.\S+$/.test(value)) {
                    errorMessage = "Invalid email format";
                } else if (id === "note" && value.split(' ').length > 30) {
                    errorMessage = "Note must be within 30 words";
                } else if (id === "city" && !/^[a-zA-Z ]+$/.test(value)) {
                    errorMessage = "City must contain only letters and spaces";
                } else if (id === "phone") {

                    value = value.replace(/^880|^80|^0/, "");
                    value = "880" + value;
                    input.value = value;
                    if (!/^[0-9]+$/.test(value)) {
                        errorMessage = "Invalid phone number";
                    }

                } else if (id === "entry_by" && !/^[0-9]+$/.test(value)) {
                    errorMessage = "Entry By must be a number";
                }
            }
            show_error_message(errorMessage, errorSpan, input)
        }



        // multiple items validation
        function validateItemsField() {
            let itemInputs = document.querySelectorAll(".item-input");

            itemInputs.forEach(input => {
                let errorSpan = document.createElement("span");
                errorSpan.style.color = "red";
                errorSpan.style.display = "none";
                input.parentNode.appendChild(errorSpan);

                let timer;
                input.addEventListener("keyup", function() {
                    clearTimeout(timer);
                    timer = setTimeout(() => {
                        ItemErrorCheck(input, errorSpan)
                    }, 2000);
                });
            });

            function ItemErrorCheck(input, errorSpan) {
                let value = input.value.trim();
                let errorMessage = "";

                if (value === "") {
                    errorMessage = "Should not empty";
                } else {
                    if (!/^[a-zA-Z]+$/.test(value)) {
                        errorMessage = "Item must be letters";
                    }
                }
                show_error_message(errorMessage, errorSpan, input)
            }
        }



        // multiple item add
        let add_item = document.querySelector("#add_item")
        let add_item_parent = document.querySelector(".add_item_parent")

        add_item.addEventListener('click', function() {
            let newItemField = document.createElement("div");
            newItemField.classList.add("d-flex", "my-2");
            newItemField.innerHTML = `
                    <input type="text" name="items[]" class="form-control item-input" placeholder="Write item name">
                    <button type="button" class="btn btn-sm btn-danger remove_item" style="width: 10%;">-</button>
                `;
            add_item_parent.appendChild(newItemField);
            validateItemsField()
        })

        add_item_parent.addEventListener('click', function(event) {
            if (event.target.classList.contains("remove_item")) {
                event.target.parentElement.remove();
                validateItemsField()
            }
        });
        validateItemsField();


        function validateItems() {
            let itemInputs = document.querySelectorAll(".item-input");
            let valid = true;
            itemInputs.forEach(input => {
                if (input.value.trim() === "") {
                    input.style.border = "1px solid red";
                    valid = false
                } else {
                    input.style.border = "1px solid #ddd";
                }
            });
            return valid;
        }

        // submit form by jquery ajax
        document.querySelector("#submit_btn").addEventListener("click", function(e) {
            e.preventDefault();
            let valid = true;
            fields.forEach(field => {
                let input = document.querySelector("#" + field);
                let errorSpan = input.parentNode.querySelector("span");
                validateField(input, errorSpan);
                if (errorSpan.style.display === "block") {
                    valid = false;
                }
            });
            if (!validateItems()) {
                valid = false;
            }
            if (valid) {
                if (getCookie("submitted")) {
                    $('.notify').removeClass("alert-success")
                    $('.notify').addClass("alert-danger")
                    $('.notify').html(`
                        <span>You have already submitted the form. Please try again after 24 hours.</span>
                    `)
                    $('.notify').css("display", "block")
                    return;
                }
                let today = new Date().toLocaleDateString('en-CA');
                let csrf_token = $('input[name="csrf_token"]').val();
                let formData = $('#submissionForm').serialize();

                $.ajax({
                    url: "<?php url('/create/post') ?>",
                    method: "POST",
                    data: formData + '&csrf_token=' + csrf_token + '&entry_at=' + today,
                    dataType: "json",
                    success: function(response) {

                        if (response.success === true) {
                            $('.notify').addClass("alert-success")
                            $('.notify').removeClass("alert-danger")
                            $('.notify').html(`
                                <span>${response.message}</span>
                            `)
                            $("#submissionForm")[0].reset();
                        } else {
                            $('.notify').removeClass("alert-success")
                            $('.notify').addClass("alert-danger")
                            $('.notify').html(`
                                <span>${response.message}</span>
                            `)
                        }
                        $('.notify').css("display", "block")
                    },
                    error: function(error) {
                        alert("There was an error submit form.");
                    }
                });


                // get cookie form browser function
                function getCookie(cname) {
                    let name = cname + "=";
                    let decodedCookie = decodeURIComponent(document.cookie);
                    let ca = decodedCookie.split(';');
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i].trim();
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

            }
        })

    });
</script>



<?php view('partials/footer') ?>