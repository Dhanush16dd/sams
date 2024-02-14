<?php
require('razorpay/Razorpay.php');

session_start();
use Razorpay\Api\Api;

$keyId = "rzp_test_EM1GNKSuswrSLb";
$keySecret = "dpOF2FmBexSyUx6Pna32yYWf";

$actual_amout = "1";
$currency = "INR";

$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         =>
'3456', 'amount' => $actual_amout * 100, 'currency' => $currency,
'payment_capture' => 1 ]; $razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder->id; // Access order ID using object notation
$_SESSION['razorpay_order_id'] = $razorpayOrderId; $displayAmount = $amount =
$orderData['amount']; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0 ,  minimum-scale=1.0, maximum-scale=1.0"
    />
    <link href="./styles/main.css" rel="stylesheet" />
    <style>
      .error-message {
        color: red;
        font-size: 0.8rem;
      }

      .toggle-next {
        border-radius: 0;
      }

      label {
        cursor: pointer;
      }

      .ellipsis {
        text-overflow: ellipsis;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
      }

      .apply-selection {
        display: none;
        width: 100%;
        margin: 0;
        padding: 5px 10px;
        border-bottom: 1px solid #ccc;
      }
      .apply-selection .ajax-link {
        display: none;
      }

      .checkboxes {
        margin: 0;
        display: none;
        border: 1px solid #ccc;
        border-top: 0;
      }
      .checkboxes .inner-wrap {
        padding: 5px 10px;
        max-height: 140px;
        overflow: auto;
      }
    </style>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
      integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Include the plugin's CSS and JS: -->
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link
      rel="stylesheet"
      href="css/bootstrap-multiselect.css"
      type="text/css"
    />
  </head>

  <body>
    <header
      class="bg-white lg:p-14 md:p-10 p-4 flex md:flex-row flex-col justify-between items-center gap-10 text-center"
    >
      <div class="">
        <img src="./imgs/sams-logo.png" alt="" class="md:w-32 w-28" />
      </div>
      <div class="">
        <h1 class="md:text-5xl text-3xl font-semibold bg-white mb-4">
          Apply to Registration on our university
        </h1>
        <!-- <p class="text-base text-gray-400">
          It is a long established fact that a reader will be distracted by the
          readable content of a page when looking at its layout. The point of
          using Lorem Ipsum is that it has a more-or-less normal distribution of
          letters, as opposed to using 'Content here, content here',
        </p> -->
      </div>
      <div class="md:block hidden">
        <img src="./imgs/sams-logo.png" alt="" class="w-32" />
      </div>
    </header>

    <section class="test-form w-screen">
      <div
        class="bg-[#f9f9f9] lg:max-w-[900px] md:max-w-[600px] max-w-[350px] mx-auto my-5 rounded-md shadow-2xl lg:p-10 md:p-6 p-2 min-h-10"
      >
        <form
          name="admissionForm"
          action="payment.php"
          method="post"
          onsubmit="return validateForm()"
        >
          <h1 class="text-2xl font-bold text-left">Personal Details</h1>
          <div
            class="grid lg:grid-cols-6 md:grid-cols-2 grid-cols-1 p-5 my-5 gap-5 border-2 border-gray-300 border-dashed"
          >
            <div class="flex flex-col col-span-3">
              <label for="name" class="font-semibold"
                >Name <span class="required">*</span></label
              >
              <input
                type="text"
                name="name"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-3">
              <label for="phone_num" class="font-semibold"
                >Phone Number <span class="required">*</span></label
              >
              <input
                type="text"
                name="phone_num"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-3">
              <label for="email" class="font-semibold"
                >Email Address <span class="required">*</span></label
              >
              <input
                type="text"
                name="email"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-3">
              <label for="insta" class="font-semibold"
                >Instagram Link </label
              >
              <input
                type="text"
                name="insta"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="rel_status" class="font-semibold"
                >Relationship Status <span class="required">*</span></label
              >
              <select
                name="rel_status"
                class="h-10 rounded-sm mt-2 px-4 py-2"
                id=""
              >
                <option value="Single">Single</option>
                <option value="married">Married</option>
              </select>
            </div>
            <div class="flex flex-col col-span-2">
              <label for="state" class="font-semibold"
                >State <span class="required">*</span></label
              >
              <input
                type="text"
                name="state"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="city" class="font-semibold"
                >City / Town / Village <span class="required">*</span></label
              >
              <input
                type="text"
                name="city"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
          </div>
          <h1 class="text-2xl font-bold text-left">Parents Details</h1>
          <div
            class="grid lg:grid-cols-6 md:grid-cols-2 grid-cols-1 p-5 my-5 gap-5 border-2 border-gray-300 border-dashed"
          >
            <div class="flex flex-col col-span-2">
              <label for="father_name" class="font-semibold"
                >Father's Name <span class="required">*</span></label
              >
              <input
                type="text"
                name="father_name"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="father_phone_num" class="font-semibold"
                >Father's Phone Number <span class="required">*</span></label
              >
              <input
                type="text"
                name="father_phone_num"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="father_occupation" class="font-semibold"
                >Father's Occupation
              </label>
              <input
                type="text"
                name="father_occupation"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="mother_name" class="font-semibold"
                >Mother's Name </label
              >
              <input
                type="text"
                name="mother_name"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="mother_phone_num" class="font-semibold"
                >Mother's Phone Number </label
              >
              <input
                type="text"
                name="mother_phone_num"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
            <div class="flex flex-col col-span-2">
              <label for="mother_occupation" class="font-semibold"
                >Mother's Occupation
              </label>
              <input
                type="text"
                name="mother_occupation"
                class="bg-white border-b-2 px-4 py-2 mt-2 rounded-sm focus:outline-none focus:border-blue-400 transition-all ease-in-out duration-100"
              />
            </div>
          </div>
          <h1 class="text-2xl font-bold text-left">Academic Details</h1>
          <div
            class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 p-5 my-5 gap-5 border-2 border-gray-300 border-dashed"
          >
           
            <div class="col-md-4">
              <div class="wrapper">
                <label for="course" class="font-semibold">Select Courses <span class="required">*</span></label>
                <!-- <div class="flex "> -->
                <button
                  type="button"
                  class="form-control toggle-next ellipsis bg-white border-b-2 px-4 py-2 mt-2 rounded-sm"
                >
                  <div class="flex justify-between">
                  <span class='w-fit'>Select Max 3 courses</span>
                    <svg
                      width="24px"
                      height="24px"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M12.7071 14.7071C12.3166 15.0976 11.6834 15.0976 11.2929 14.7071L6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289C6.68342 7.90237 7.31658 7.90237 7.70711 8.29289L12 12.5858L16.2929 8.29289C16.6834 7.90237 17.3166 7.90237 17.7071 8.29289C18.0976 8.68342 18.0976 9.31658 17.7071 9.70711L12.7071 14.7071Z"
                        fill="#000000"
                      /></svg>
                  </div>
                </button>
                <!-- <img src="./imgs/dropdown.svg" width="30" height="30"  alt=""> -->
                <!-- </div> -->
                <div class="checkboxes" id="Lorems">
                  <!-- <label class="apply-selection">
          <input type="checkbox" value="" class="ajax-link" />
          &#x2714; apply selection
        </label> -->
                  <div class="inner-wrap">
                    <label>
                      <input type="checkbox" value="dolor" class="ckkBox val" />
                      <span>Cats (34) </span> </label
                    ><br />

                    <label>
                      <input type="checkbox" value="lorem" class="ckkBox val" />
                      <span>Dogs (234)</span> </label
                    ><br />

                    <label>
                      <input type="checkbox" value="ipsum" class="ckkBox val" />
                      <span>Birds (12)</span> </label
                    ><br />

                    <label>
                      <input type="checkbox" value="dolor" class="ckkBox val" />
                      <span>Cats 2 (34) </span> </label
                    ><br />

                    <label>
                      <input type="checkbox" value="lorem" class="ckkBox val" />
                      <span>Dogs 2 (234)</span> </label
                    ><br />

                    <label>
                      <input type="checkbox" value="ipsum" class="ckkBox val" />
                      <span>Birds 2 (12)</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex flex-col">
              <label for="highest_qualification" class="font-semibold">
                Highest Qualification<span class="required">*</span></label
              >
              <select
                name="rel_status"
                class="h-10 rounded-sm mt-2 px-4 py-2"
                id=""
              >
                <option value="SSLC">SSLC</option>
                <option value="HSC">HSC</option>
                <option value="diploma">Diploma</option>
                <option value="under_graduate">Under Graduate</option>
              </select>
            </div>
            <div class="flex flex-col">
              <label for="lateral" class="font-semibold"
                >Lateral Entry <span class="required">*</span></label
              >
              <div class="flex gap-5 items-center mt-4">
                <div class="">
                  <input type="radio" name="lateral" />
                  <label for="">Yes</label>
                </div>
                <div class="">
                  <input type="radio" name="lateral" />
                  <label for="">No</label>
                </div>
              </div>
            </div>
          </div>
          <div class="submit flex justify-end">
            <button
              id="rzp-button1"
              type="button"
              class="p-2 rounded-lg min-w-[200px] bg-slate-400 text-white text-lg font-bold hover:bg-slate-600"
            >
              Make Payment
            </button>
          </div>
        </form>
      </div>
    </section>

    <script src="./main.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      var options = {
        key: "<?php echo $keyId; ?>",
        amount: "<?php echo $amount; ?>",
        currency: "<?php echo $currency; ?>",
        handler: function (response) {
          document.admissionForm.submit();
        },
        name: "Acme Corp",
        description: "Test Transaction",
        image: "https://example.com/your_logo",
        order_id: "<?php echo $razorpayOrderId; ?>",
        prefill: {
          name: "Gaurav Kumar",
          email: "gaurav.kumar@example.com",
          contact: "9000090000",
        },
        notes: {
          address: "Razorpay Corporate Office",
        },
        theme: {
          color: "#3399cc",
        },
      };

      var rzp1 = new Razorpay(options);
      document.getElementById("rzp-button1").onclick = function (e) {
        // Validate the form
        var isValidForm = validateForm();

        if (isValidForm) {
          rzp1.open();
        } else {
          e.preventDefault();
        }
      };

      </script>
     <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>
