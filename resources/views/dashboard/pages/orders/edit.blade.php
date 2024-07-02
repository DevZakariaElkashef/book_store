@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-edit">
            <!-- Invoice Edit-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row mx-0">
                            <div class="col-md-7 mb-md-0 mb-4 ps-0">
                                <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                                    <span class="app-brand-logo demo">
                                        <span style="color: var(--bs-primary)">
                                            <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                                                    fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                                                <path
                                                    d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                                                    fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                                                <path
                                                    d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                                                    fill="currentColor" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_2989_100980" x1="5.36642"
                                                        y1="0.849138" x2="10.532" y2="24.104"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-opacity="1" />
                                                        <stop offset="1" stop-opacity="0" />
                                                    </linearGradient>
                                                    <linearGradient id="paint1_linear_2989_100980" x1="5.19475"
                                                        y1="0.849139" x2="10.3357" y2="24.1155"
                                                        gradientUnits="userSpaceOnUse">
                                                        <stop offset="0" stop-opacity="1" />
                                                        <stop offset="1" stop-opacity="0" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="h4 mb-0 app-brand-text fw-bold">Materialize</span>
                                </div>
                                <p class="mb-1">Office 149, 450 South Brand Brooklyn</p>
                                <p class="mb-1">San Diego County, CA 91905, USA</p>
                                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                <dl class="row mb-2 g-2">
                                    <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                        <span class="h4 text-capitalize mb-0 text-nowrap">Invoice</span>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <div class="input-group input-group-merge disabled">
                                            <span class="input-group-text">#</span>
                                            <input type="text" class="form-control" disabled placeholder="74909"
                                                value="74909" id="invoiceId" />
                                        </div>
                                    </dd>
                                    <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                        <span class="fw-normal">Date:</span>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <input type="text" class="form-control invoice-date" placeholder="YYYY-MM-DD" />
                                    </dd>
                                    <dt class="col-sm-6 mb-2 d-md-flex align-items-center justify-content-end">
                                        <span class="fw-normal">Due Date:</span>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <input type="text" class="form-control due-date" placeholder="YYYY-MM-DD" />
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="my-3">
                                <h6 class="pb-2">Invoice To:</h6>
                                <p class="mb-1">Thomas shelby</p>
                                <p class="mb-1">Shelby Company Limited</p>
                                <p class="mb-1">Small Heath, B10 0HF, UK</p>
                                <p class="mb-1">718-986-6062</p>
                                <p class="mb-0">peakyFBlinders@gmail.com</p>
                            </div>
                            <div class="my-3">
                                <h6 class="pb-2">Bill To:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Total Due:</td>
                                            <td>$12,110.55</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form class="source-item pt-1">
                            <div class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 p-3">
                                            <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                <h6 class="mb-2 repeater-title fw-medium">Item</h6>
                                                <select class="form-select item-details mb-3">
                                                    <option value="App Design">App Design</option>
                                                    <option value="App Customization" selected>App Customization</option>
                                                    <option value="ABC Template">ABC Template</option>
                                                    <option value="App Development">App Development</option>
                                                </select>
                                                <textarea class="form-control" rows="2">
The most developer friendly & highly customizable HTML5 Admin</textarea
                        >
                      </div>
                      <div class="col-md-3 col-12 mb-md-0 mb-3">
                        <h6 class="mb-2 repeater-title fw-medium">Cost</h6>
                        <input
                          type="number"
                          class="form-control invoice-item-price mb-3"
                          value="24"
                          placeholder="24"
                          min="12" />
                        <div class="d-flex flex-column gap-2">
                          <span>Discount:</span>
                          <span>
                            <span class="discount me-2">0%</span>
                            <span
                              class="tax-1 me-2"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="Tax 1"
                              >0%</span
                            >
                            <span class="tax-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Tax 2"
                              >0%</span
                            >
                          </span>
                        </div>
                      </div>
                      <div class="col-md-2 col-12 mb-md-0 mb-3">
                        <h6 class="mb-2 repeater-title fw-medium">Qty</h6>
                        <input
                          type="number"
                          class="form-control invoice-item-qty"
                          value="1"
                          placeholder="1"
                          min="1"
                          max="50" />
                      </div>
                      <div class="col-md-1 col-12 pe-0">
                        <h6 class="mb-2 repeater-title fw-medium">Price</h6>
                        <p class="mb-0">$24.00</p>
                      </div>
                    </div>
                    <div
                      class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                      <i class="mdi mdi-close cursor-pointer" data-repeater-delete></i>
                      <div class="dropdown">
                        <i
                          class="mdi mdi-cog-outline cursor-pointer more-options-dropdown"
                          role="button"
                          id="dropdownMenuButton"
                          data-bs-toggle="dropdown"
                          data-bs-auto-close="outside"
                          aria-expanded="false">
                        </i>
                        <div
                          class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                          aria-labelledby="dropdownMenuButton">
                          <div class="row g-3">
                            <div class="col-12">
                              <label for="discountInput" class="form-label">Discount(%)</label>
                              <input
                                type="number"
                                class="form-control"
                                id="discountInput"
                                min="0"
                                max="100" />
                            </div>
                            <div class="col-md-6">
                              <label for="taxInput1" class="form-label">Tax 1</label>
                              <select name="tax-1-input" id="taxInput1" class="form-select tax-select">
                                <option value="0%" selected>0%</option>
                                <option value="1%">1%</option>
                                <option value="10%">10%</option>
                                <option value="18%">18%</option>
                                <option value="40%">40%</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label for="taxInput2" class="form-label">Tax 2</label>
                              <select name="tax-2-input" id="taxInput2" class="form-select tax-select">
                                <option value="0%" selected>0%</option>
                                <option value="1%">1%</option>
                                <option value="10%">10%</option>
                                <option value="18%">18%</option>
                                <option value="40%">40%</option>
                              </select>
                            </div>
                          </div>
                          <div class="dropdown-divider my-3"></div>
                          <button type="button" class="btn btn-label-primary btn-apply-changes">Apply</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="button" class="btn btn-primary" data-repeater-create>
                    <i class="mdi mdi-plus me-1"></i> Add Item
                  </button>
                </div>
              </div>
            </form>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-md-0 mb-3">
                <div class="form-floating form-floating-outline mb-4">
                  <input
                    type="text"
                    class="form-control"
                    id="salesperson"
                    placeholder="Edward Crowley"
                    value="Edward Crowley" />
                  <label for="salesperson">Salesperson</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                  <input
                    type="text"
                    class="form-control"
                    id="invoiceMsg"
                    placeholder="Thanks for your business"
                    value="Thanks for your business" />
                  <label for="invoiceMsg">Customer Notes</label>
                </div>
              </div>
              <div class="col-md-6 d-flex justify-content-md-end">
                <div class="invoice-calculations">
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Subtotal:</span>
                    <span class="fw-semibold">$5000.25</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Discount:</span>
                    <span class="fw-semibold">$00.00</span>
                  </div>
                  <div class="d-flex justify-content-between mb-2">
                    <span class="w-px-100">Tax:</span>
                    <span class="fw-semibold">$100.00</span>
                  </div>
                  <hr />
                  <div class="d-flex justify-content-between">
                    <span class="w-px-100">Total:</span>
                    <span class="fw-semibold">$5100.25</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="my-0" />
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="note" class="form-label fw-bold">Note:</label>
                  <textarea class="form-control" rows="2" id="note">
It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Invoice Edit-->

      <!-- Invoice Actions -->
      <div class="col-lg-3 col-12 invoice-actions">
        <div class="card mb-4">
          <div class="card-body">
            <button
              class="btn btn-primary d-grid w-100 mb-3"
              data-bs-toggle="offcanvas"
              data-bs-target="#sendInvoiceOffcanvas">
              <span class="d-flex align-items-center justify-content-center text-nowrap"
                ><i class="mdi mdi-send-outline scaleX-n1-rtl me-2"></i>Send Invoice</span
              >
            </button>
            <a href="./app-invoice-preview.html" class="btn btn-outline-secondary w-100 me-2 mb-3">Preview</a>
            <button type="button" class="btn btn-outline-secondary w-100 mb-3">Save</button>
            <button
              class="btn btn-success d-grid w-100 mb-3"
              data-bs-toggle="offcanvas"
              data-bs-target="#addPaymentOffcanvas">
              <span class="d-flex align-items-center justify-content-center text-nowrap"
                ><i class="mdi mdi-currency-usd me-1"></i>Add Payment</span
              >
            </button>
          </div>
        </div>
        <div>
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-select bg-body mb-4" id="select-payment-edit">
              <option value="Bank Account">Bank Account</option>
              <option value="Paypal">Paypal</option>
              <option value="Card">Credit/Debit Card</option>
              <option value="UPI Transfer">UPI Transfer</option>
            </select>
            <label for="select-payment-edit" class="bg-body">Accept payments via</label>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <label for="payment-terms" class="mb-0">Payment Terms</label>
            <label class="switch switch-primary me-0">
              <input type="checkbox" class="switch-input" id="payment-terms" checked />
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label"></span>
            </label>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <label for="client-notes" class="mb-0">Client Notes</label>
            <label class="switch switch-primary me-0">
              <input type="checkbox" class="switch-input" id="client-notes" />
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label"></span>
            </label>
          </div>
          <div class="d-flex justify-content-between">
            <label for="payment-stub" class="mb-0">Payment Stub</label>
            <label class="switch switch-primary me-0">
              <input type="checkbox" class="switch-input" id="payment-stub" />
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label"></span>
            </label>
          </div>
        </div>
      </div>
      <!-- /Invoice Actions -->
    </div>

    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
      <div class="offcanvas-header mb-3">
        <h5 class="offcanvas-title">Send Invoice</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body flex-grow-1">
        <form>
          <div class="form-floating form-floating-outline mb-4">
            <input
              type="text"
              class="form-control"
              id="invoice-from"
              value="shelbyComapny@email.com"
              placeholder="company@email.com" />
            <label for="invoice-from">From</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input
              type="text"
              class="form-control"
              id="invoice-to"
              value="qConsolidated@email.com"
              placeholder="company@email.com" />
            <label for="invoice-to">To</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input
              type="text"
              class="form-control"
              id="invoice-subject"
              value="Invoice of purchased Admin Templates"
              placeholder="Invoice regarding goods" />
            <label for="invoice-subject">Subject</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea class="form-control" name="invoice-message" id="invoice-message" style="height: 190px">
Dear Queen Consolidated,
Thank you for your business, always a pleasure to work with you!
We have generated a new invoice in the amount of $95.59
We would appreciate payment of this invoice by 05/11/2021</textarea
            >
            <label for="invoice-message">Message</label>
          </div>
          <div class="mb-4">
            <span class="badge bg-label-primary">
              <i class="mdi mdi-link-variant mdi-14px me-1"></i>
              <span class="align-middle">Invoice Attached</span>
            </span>
          </div>
          <div class="mb-3 d-flex flex-wrap">
            <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /Send Invoice Sidebar -->

    <!-- Add Payment Sidebar -->
    <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
      <div class="offcanvas-header mb-3">
        <h5 class="offcanvas-title">Add Payment</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body flex-grow-1">
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
          <p class="mb-0">Invoice Balance:</p>
          <p class="fw-bold mb-0">$5000.00</p>
        </div>
        <form>
          <div class="input-group input-group-merge mb-4">
            <span class="input-group-text">$</span>
            <div class="form-floating form-floating-outline">
              <input
                type="text"
                id="invoiceAmount"
                name="invoiceAmount"
                class="form-control invoice-amount"
                placeholder="100" />
              <label for="invoiceAmount">Payment Amount</label>
            </div>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <input id="payment-date" class="form-control invoice-date" type="text" />
            <label for="payment-date">Payment Date</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <select class="form-select" id="payment-method">
              <option value="" selected disabled>Select payment method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Debit Card">Debit Card</option>
              <option value="Credit Card">Credit Card</option>
              <option value="Paypal">Paypal</option>
            </select>
            <label for="payment-method">Payment Method</label>
          </div>
          <div class="form-floating form-floating-outline mb-4">
            <textarea class="form-control" id="payment-note" style="height: 62px"></textarea>
                                                <label for="payment-note">Internal Payment Note</label>
                                            </div>
                                            <div class="mb-3 d-flex flex-wrap">
                                                <button type="button" class="btn btn-primary me-3"
                                                    data-bs-dismiss="offcanvas">Send</button>
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="offcanvas">Cancel</button>
                                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Add Payment Sidebar -->

                <!-- /Offcanvas -->
            </div>
        @endsection
