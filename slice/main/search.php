<?php $title = 'Search'; ?>
<?php include 'tpl/includes/head.inc'; ?>
<body>
<div class="outer-wrapper">
  <?php include 'tpl/layout/header.inc'; ?>
  <div class="content-wrapper">
    <header class="title"><h1>Search</h1></header>
    <div class="content-inner">
      <div class="text">
        <div class="b-search container">
          <div class="region region-content">
            <div id="block-system-main" class="block block-system">
              <div class="content">
                <form class="search-form" action="/search/node" method="post" id="search-form" accept-charset="UTF-8"><div><div class="container-inline form-wrapper" id="edit-basic"><div class="form-item form-type-textfield form-item-keys">
                        <label for="edit-keys">Enter your keywords </label>
                        <input type="text" id="edit-keys" name="keys" value="ыфва" size="40" maxlength="255" class="form-text">
                      </div>
                      <input type="submit" id="edit-submit" name="op" value="Search" class="form-submit"></div><input type="hidden" name="form_build_id" value="form-Mx8Iu0MWYIFqH64m1TrKKwuKueuUncIhQEUtANLRezM">
                    <input type="hidden" name="form_id" value="search_form">
                  </div>
                </form>
                <h2>Your search yielded no results</h2>
                <ul>
                  <li>Check if your spelling is correct.</li>
                  <li>Remove quotes around phrases to search for each word individually. <em>bike shed</em> will often show more results than <em>"bike shed"</em>.</li>
                  <li>Consider loosening your query with <em>OR</em>. <em>bike OR shed</em> will often show more results than <em>bike shed</em>.</li>
                </ul>
              </div>
            </div>
            <div class="modal fade b-modal" id="modal-join" tabindex="-1" role="dialog" aria-labelledby="modalJoin" aria-hidden="true">
              <div class="modal-dialog">
                <div class="content modal-content">
                  <div id="node-7" class="node node-webform clearfix" about="/content/subscribe" typeof="sioc:Item foaf:Document">

                    <span property="dc:title" content="Subscribe" class="rdf-meta element-hidden"></span><span property="sioc:num_replies" content="0" datatype="xsd:integer" class="rdf-meta element-hidden"></span>

                    <div class="content">
                      <div id="webform-ajax-wrapper-7"><form class="webform-client-form webform-client-form-7" enctype="multipart/form-data" action="/search/node/%D1%8B%D1%84%D0%B2%D0%B0" method="post" id="webform-client-form-7" accept-charset="UTF-8"><div><div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                              <h3 id="modalJoin">JOIN OUR EMAIL LIST</h3>
                              <p>Stay updated on important news and deadlines.</p>
                            </div>
                            <div class="modal-body">
                              <div class="form form-join">
                                <div class="row">
                                  <div class="col-sm-12 field-inline-type-2 field-email form-item webform-component webform-component-email webform-component--email">
                                    <label for="edit-submitted-email">Email <span class="form-required" title="This field is required.">*</span></label>
                                    <input required="required" class="email form-text form-email required" type="email" id="edit-submitted-email" name="submitted[email]" size="60">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6 field-inline-type-2 field-first-name form-item webform-component webform-component-textfield webform-component--first-name">
                                    <label for="edit-submitted-first-name">First Name <span class="form-required" title="This field is required.">*</span></label>
                                    <input required="required" type="text" id="edit-submitted-first-name" name="submitted[first_name]" value="" size="60" maxlength="128" class="form-text required">
                                  </div>
                                  <div class="col-sm-6 field-inline-type-2 form-item webform-component webform-component-textfield webform-component--last-name">
                                    <label for="edit-submitted-last-name">Last Name <span class="form-required" title="This field is required.">*</span></label>
                                    <input required="required" type="text" id="edit-submitted-last-name" name="submitted[last_name]" value="" size="60" maxlength="128" class="form-text required">
                                  </div>

                                </div>
                                <div class="row">
                                  <div class="col-sm-9 field-inline-type-2 field-city form-item webform-component webform-component-textfield webform-component--city">
                                    <label for="edit-submitted-city">City </label>
                                    <input type="text" id="edit-submitted-city" name="submitted[city]" value="" size="60" maxlength="128" class="form-text">
                                  </div>
                                  <div class="col-sm-3 field-inline-type-2 form-item webform-component webform-component-select webform-component--state">
                                    <label for="edit-submitted-state">State </label>
                                    <select id="edit-submitted-state" name="submitted[state]" class="form-select"><option value="" selected="selected">- None -</option><option value="AL">Alabama</option><option value="AK">Alaska</option><option value="AS">American Samoa</option><option value="AZ">Arizona</option><option value="AR">Arkansas</option><option value="CA">California</option><option value="CO">Colorado</option><option value="CT">Connecticut</option><option value="DE">Delaware</option><option value="DC">District of Columbia</option><option value="FL">Florida</option><option value="GA">Georgia</option><option value="GU">Guam</option><option value="HI">Hawaii</option><option value="ID">Idaho</option><option value="IL">Illinois</option><option value="IN">Indiana</option><option value="IA">Iowa</option><option value="KS">Kansas</option><option value="KY">Kentucky</option><option value="LA">Louisiana</option><option value="ME">Maine</option><option value="MH">Marshall Islands</option><option value="MD">Maryland</option><option value="MA">Massachusetts</option><option value="MI">Michigan</option><option value="MN">Minnesota</option><option value="MS">Mississippi</option><option value="MO">Missouri</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NV">Nevada</option><option value="NH">New Hampshire</option><option value="NJ">New Jersey</option><option value="NM">New Mexico</option><option value="NY">New York</option><option value="NC">North Carolina</option><option value="ND">North Dakota</option><option value="MP">Northern Marianas Islands</option><option value="OH">Ohio</option><option value="OK">Oklahoma</option><option value="OR">Oregon</option><option value="PW">Palau</option><option value="PA">Pennsylvania</option><option value="PR">Puerto Rico</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option><option value="SD">South Dakota</option><option value="TN">Tennessee</option><option value="TX">Texas</option><option value="UT">Utah</option><option value="VT">Vermont</option><option value="VI">Virgin Islands</option><option value="VA">Virginia</option><option value="WA">Washington</option><option value="WV">West Virginia</option><option value="WI">Wisconsin</option><option value="WY">Wyoming</option></select>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12 field-inline-type-2 field-organization form-item webform-component webform-component-textfield webform-component--organization">
                                    <label for="edit-submitted-organization">Organization </label>
                                    <input type="text" id="edit-submitted-organization" name="submitted[organization]" value="" size="60" maxlength="128" class="form-text">
                                  </div>
                                </div>
                                <br>
                                <div class="form-part">
                                  <div class="form-item webform-component webform-component-checkboxes webform-component--please-check-your-areas-of-interest">
                                    <label for="edit-submitted-please-check-your-areas-of-interest">Please check your area(s) of interest </label>
                                    <div id="edit-submitted-please-check-your-areas-of-interest" class="form-checkboxes"><div class="form-item form-type-checkbox form-item-submitted-please-check-your-areas-of-interest-Oklahoma-Summer-Arts-Institute">
                                        <input type="checkbox" id="edit-submitted-please-check-your-areas-of-interest-1" name="submitted[please_check_your_areas_of_interest][Oklahoma Summer Arts Institute]" value="Oklahoma Summer Arts Institute" class="form-checkbox">  <label class="option" for="edit-submitted-please-check-your-areas-of-interest-1">Oklahoma Summer Arts Institute </label>

                                      </div>
                                      <div class="form-item form-type-checkbox form-item-submitted-please-check-your-areas-of-interest-Oklahoma-Fall-Arts-Institute">
                                        <input type="checkbox" id="edit-submitted-please-check-your-areas-of-interest-2" name="submitted[please_check_your_areas_of_interest][Oklahoma Fall Arts Institute]" value="Oklahoma Fall Arts Institute" class="form-checkbox">  <label class="option" for="edit-submitted-please-check-your-areas-of-interest-2">Oklahoma Fall Arts Institute </label>

                                      </div>
                                      <div class="form-item form-type-checkbox form-item-submitted-please-check-your-areas-of-interest-Volunteer-Opportunties">
                                        <input type="checkbox" id="edit-submitted-please-check-your-areas-of-interest-3" name="submitted[please_check_your_areas_of_interest][Volunteer Opportunties]" value="Volunteer Opportunties" class="form-checkbox">  <label class="option" for="edit-submitted-please-check-your-areas-of-interest-3">Volunteer Opportunties </label>

                                      </div>
                                      <div class="form-item form-type-checkbox form-item-submitted-please-check-your-areas-of-interest-General-Interest">
                                        <input type="checkbox" id="edit-submitted-please-check-your-areas-of-interest-4" name="submitted[please_check_your_areas_of_interest][General Interest]" value="General Interest" class="form-checkbox">  <label class="option" for="edit-submitted-please-check-your-areas-of-interest-4">General Interest </label>

                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-item webform-component webform-component-radios webform-component--are-you-an-alumnus-or-parent">
                                    <label for="edit-submitted-are-you-an-alumnus-or-parent">Are you an alumnus or parent? </label>
                                    <div id="edit-submitted-are-you-an-alumnus-or-parent" class="form-radios"><div class="form-item form-type-radio form-item-submitted-are-you-an-alumnus-or-parent">
                                        <input type="radio" id="edit-submitted-are-you-an-alumnus-or-parent-1" name="submitted[are_you_an_alumnus_or_parent]" value="I attended the Fall Arts Institute" class="form-radio">  <label class="option" for="edit-submitted-are-you-an-alumnus-or-parent-1">I attended the Fall Arts Institute </label>

                                      </div>
                                      <div class="form-item form-type-radio form-item-submitted-are-you-an-alumnus-or-parent">
                                        <input type="radio" id="edit-submitted-are-you-an-alumnus-or-parent-2" name="submitted[are_you_an_alumnus_or_parent]" value="I attended the Summer Arts Institute" class="form-radio">  <label class="option" for="edit-submitted-are-you-an-alumnus-or-parent-2">I attended the Summer Arts Institute </label>

                                      </div>
                                      <div class="form-item form-type-radio form-item-submitted-are-you-an-alumnus-or-parent">
                                        <input type="radio" id="edit-submitted-are-you-an-alumnus-or-parent-3" name="submitted[are_you_an_alumnus_or_parent]" value="My child attended the Summer Arts Institute" class="form-radio">  <label class="option" for="edit-submitted-are-you-an-alumnus-or-parent-3">My child attended the Summer Arts Institute </label>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-actions content-right">
                                  <div class="form-actions"><input class="webform-submit button-primary form-submit ajax-processed" type="submit" id="edit-webform-ajax-submit-7" name="op" value="Subscribe"></div>    </div>
                              </div>

                              <input type="hidden" name="details[sid]">
                              <input type="hidden" name="details[page_num]" value="1">
                              <input type="hidden" name="details[page_count]" value="1">
                              <input type="hidden" name="details[finished]" value="0">
                              <input type="hidden" name="form_build_id" value="form-avdWshyQvdvOU9KKvyx5EpMDIQADhK_kJRYJI2WL0Zo">
                              <input type="hidden" name="form_id" value="webform_client_form_7">
                              <input type="hidden" name="webform_ajax_wrapper_id" value="webform-ajax-wrapper-7">
                            </div>
                          </div></form></div>  </div>



                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'tpl/layout/footer.inc'; ?>
</div>
</body>
</html>