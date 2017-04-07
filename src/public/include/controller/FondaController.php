<?php

namespace fonda\controller;

use AuthorizedController;
use entities\Fonda;
use model\FondaGroupModel;
use model\FondaModel;
use model\LocationModel;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonData;
use responses\ResponseJsonError;

require_once 'AuthorizedController.php';

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/06/2017
 * Time: 7:20 PM
 */
class FondaController extends AuthorizedController
{

    function getMethod()
    {
        return [PUT];
    }

    function getUrl()
    {
        return '/fonda';
    }

    function getRoleName()
    {
        return 'Vendor';
    }

    function exec(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $_code = $this->preExecute($request);
        if ($_code != 0)
            return ResponseJsonBadRequest::responseBadRequest($request, $response, $_code);

        $fonda = new Fonda();
        $fonda->name = $request->getParam('name', null);
        $fonda->locationId = $request->getParam('location_id', null);
        $fonda->groupId = $request->getParam('group_id', null);
        $fonda->scale = $request->getParam('scale', null);
        $fonda->openTime = $request->getParam('open_time', null);
        $fonda->closeTime = $request->getParam('close_time', null);
        $fonda->openDay = $request->getParam('open_day', null);
        $fonda->phone1 = $request->getParam('phone_1', null);
        $fonda->phone2 = $request->getParam('phone_2', null);
        $fonda->active = $request->getParam('is_active', 1);

        $locationModel = new LocationModel();
        $fonda->location = $locationModel->findLocationById($fonda->locationId);

        $fondaGroupModel = new FondaGroupModel();
        $fonda->group = $fondaGroupModel->findFondaGroupById($fonda->groupId);

        $fonda->user_id = $this->user->id;
        $fonda->user = $this->user;

        try{
            $this->assertNotNullParams($fonda->name, 'Fonda name is required');
            $this->assertNotNullParams($fonda->locationId, 'Fonda location is required');
            $this->assertNotNullParams($fonda->groupId, 'Fonda group is required');
            $this->assertNotNullParams($fonda->scale, 'Fonda scaling is required');

            $fondaModel = new FondaModel();
            $fondaModel->create($fonda);

            $fonda->id = $fondaModel->lastInsertId();

            return ResponseBuilder::build($fonda, $response, $request, 200);
        }
        catch(ResponseJsonError $jsonError){
            $response = ResponseBuilder::build($jsonError, $response, $request, 500);
        }
        return $response;
    }
}