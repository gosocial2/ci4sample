<?php  namespace App\Controllers;


use App\Models\CountryModel;

use App\Models\CityModel;
use App\Entities\City;

class CitiesController extends GoBaseController { 

    protected static $primaryModelName = 'CityModel';
    protected static $singularObjectName = 'City';
    protected static $singularObjectNameCc = 'city';
    protected static $pluralObjectName = 'Cities';
    protected static $pluralObjectNameCc = 'cities';

    protected static $viewPath = 'cityViews/';

    protected $formValidationRules = [
		'country_code' => 'trim',
		'city_name' => 'trim|required|max_length[60]',
		];

    public function index() {

         $this->viewData['usingDataTables'] = true;
         
		 $this->viewData['cityList'] = $this->primaryModel->findAllWithCountries('*');

         parent::index();

    }

    public function add() {

        $cityModel = new CityModel();

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $postData = $this->request->getPost();
            $sanitizedData = [];
        
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;

            $city = new City($sanitizedData);
			$this->formValidationRules['city_name'] .= '|is_unique[tbl_cities.city_name]';

            $formValid = $this->canValidate();
            $successfulResult = true;
            
            if ($formValid) :
                try {
                    $cityModel->save($city);
                } catch (\Exception $e) {
                    $successfulResult = false;
                    $userFriendlyErrMsg = 'An error occurred in an attempt to save a new '.static::$singularObjectName.' to the database :';
                    $result['error'] = $userFriendlyErrMsg;
                    $query = $cityModel->db->getLastQuery();
                    log_message('error', $userFriendlyErrMsg.PHP_EOL.$e->getMessage().PHP_EOL.$query);
                    $dbError = $cityModel->db->error();
                    if (!empty($dbError['message'])) :
                        log_message('error', $dbError['code'].' : '.$dbError['message']);
                        $result['error'] .= '<br><br>'.$dbError['code'].' : '.$dbError['message'];
                    endif;
                }

            else:
                $successfulResult = false;
                $this->viewData['errorMessage'] .= "The errors on the form need to be corrected";
            endif;

            $thenRedirect = true;

            if ($successfulResult) :

                $insertedId = $this->primaryModel->db->insertID();
                $theId = $insertedId;

                $message = 'The ' . strtolower(static::$singularObjectName) . ' was successfully saved' . (empty($this->primaryModel::$labelField) ? 'with name <i>' . $city->{$this->primaryModel::$labelField} . '</i>' : '').'. ';
                $message .= '<a href="' . route_to('editCity', $theId) . '">Continue editing?</a>';

                if ($thenRedirect) :
                    return $this->redirect2listView('successMessage', $message);
                else:
                    $this->viewData['successMessage'] = $message;
                endif;
            else:
                if ($formValid) {
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved due to an error';
                }
                if (!empty($result['error'])) :
                  $this->viewData['errorMessage'] .= ':<br>' . $result['error'];
                else:
                  $this->viewData['errorMessage'] .= '.';
                endif;
            endif;
        
        endif; // ($requestMethod === 'post')
        
        $this->viewData['city'] = $city ?? new City();
		$this->viewData['countryList'] = $this->getCountryListItems();


        $this->viewData['formAction'] = route_to('createCity');

        $this->displayForm(__METHOD__);
    }

    public function edit($requestedId = null) {

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $city = $this->primaryModel->find($id);

        if ($city == false) :
            $message = 'No such city ( with identifier ' . $id . ') was found in the database.';
            return $this->redirect2listView("errorMessage", $message);
        endif;

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :
            $postData = $this->request->getPost();
            $sanitizedData = [];
            foreach ($postData as $k => $v) :
                $sanitizationResult = goSanitize($v);
                $sanitizedData[$k] = $sanitizationResult[0];
            endforeach;
        
            if ($this->request->getPost('enabled') == null ) {
                $sanitizedData['enabled'] = false;
            }

        
            $formValid = $this->canValidate();
            $successfulResult = false; // for now

            if ($formValid) :
                try {
                    $successfulResult = $this->primaryModel->update($id, $sanitizedData);
                } catch (\Exception $e) {
                    $query = $this->primaryModel->db->getLastQuery();
                    $dbError = $this->primaryModel->db->error();
                    log_message('error', 'An error occurred in an attempt to update the '.static::$singularObjectName.' with ID '.$id.' to the database :'.PHP_EOL.$e->getMessage().PHP_EOL.$query.PHP_EOL.$dbError['code'].' : '.$dbError['message']);
                }
                $city = $city->mergeAttributes($sanitizedData);
            endif;

            $thenRedirect = true;

            if ($successfulResult) :
                $theId = $city->id;
                $message = 'The ' . strtolower(static::$singularObjectName) . (!empty($this->primaryModel::$labelField) ? ' named <b>' . $city->{$this->primaryModel::$labelField} . '</b>' : '');
                $message .= ' was successfully updated. ';
                $message .= '<a href="' . route_to('editCity', $theId) . '">Continue editing?</a>';

                if ($thenRedirect) :
                    return $this->redirect2listView('successMessage', $message);
                else:
                    $this->viewData['successMessage'] = $message;
                endif;
            else: // ($successfulResult == false)
                if ($formValid) {
                    $this->viewData['errorMessage'] .= 'The ' . strtolower(static::$singularObjectName) . ' was not saved due to an error';
                }
                if (!empty($result['error'])) :
                    $this->viewData['errorMessage'] .= ':<br>' . $result['error'];
                else:
                    $this->viewData['errorMessage'] .= '.';
                endif;
            endif; // ($successfulResult)
        endif; // ($requestMethod === 'post')

        $this->viewData['city'] = $city;
		$this->viewData['countryList'] = $this->getCountryListItems();

        
        $theId = $id;
		$this->viewData['formAction'] = route_to('updateCity', $theId);

        
        $this->displayForm(__METHOD__, $id);
    } // function edit(...)

	protected function getCountryListItems() { 
		$countryModel = new CountryModel();
		$onlyActiveOnes = true;
		$data = $countryModel->getAllForMenu('iso_code, country_name','country_name', $onlyActiveOnes);

		return $data;
	}


}
