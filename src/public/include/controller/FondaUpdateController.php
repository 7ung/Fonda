<?php
use entities\Fonda;
use model\FondaGroupModel;
use model\LocationModel;
use responses\ResponseBuilder;
use responses\ResponseJsonBadRequest;
use responses\ResponseJsonError;

/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/07/2017
 * Time: 3:10 PM
 */
class FondaUpdateController extends AuthorizedController
{

    function getRoleName()
    {
        return 'Vendor';
    }

    function getMethod()
    {
        return [PUT];
    }

    function getUrl()
    {
        return '/fondas/{id}';
    }

    function exec(\Slim\Http\Request $request, \Slim\Http\Response $response)
    {
        $_code = $this->preExecute($request);
        if ($_code != 0)
            return ResponseJsonBadRequest::responseBadRequest($request, $response, $_code);

        $id = $request->getAttribute('id', null);
        try{
            $this->assertNotNullParams($id, 'Fonda id must not null');

            // findFondaById
            $fondaModel = new \model\FondaModel();
            $fonda = $fondaModel->findFondaById($id);

            if ($fonda == null || $fonda->user_id != $this->user->id)
                ResponseJsonBadRequest::responseBadRequest($request, $response, 40403);

            $fonda->name = $request->getParam('name', $fonda->name);
            $fonda->locationId = $request->getParam('location_id', $fonda->locationId);
            $fonda->groupId = $request->getParam('group_id', $fonda->groupId);
            $fonda->scale = $request->getParam('scale', $fonda->scale);
            $fonda->openTime = $request->getParam('open_time', $fonda->openTime);
            $fonda->closeTime = $request->getParam('close_time', $fonda->closeTime);
            $fonda->openDay = $request->getParam('open_day', $fonda->openDay);
            $fonda->phone1 = $request->getParam('phone_1', $fonda->phone1);
            $fonda->phone2 = $request->getParam('phone_2', $fonda->phone2);
            $fonda->active = $request->getParam('is_active', $fonda->active);
            $fonda->user = $this->user;

            $this->assertNotNullParams($fonda->name, 'Fonda name is required');
            $this->assertNotNullParams($fonda->locationId, 'Fonda location is required');
            $this->assertNotNullParams($fonda->groupId, 'Fonda group is required');
            $this->assertNotNullParams($fonda->scale, 'Fonda scaling is required');

            $locationModel = new LocationModel();
            $fonda->location = $locationModel->findLocationById($fonda->locationId);

            if ($fonda->location == null){
                throw new \exception\InvalidArgumentException('Location not found', 500);
            }

            $fondaGroupModel = new FondaGroupModel();
            $fonda->group = $fondaGroupModel->findFondaGroupById($fonda->groupId);

            if ($fonda->group == null)
                throw new \exception\InvalidArgumentException('Fonda group not found', 500);

            $fondaModel->save($fonda);
            $fonda = $fondaModel->findFondaById($fonda->id);
            $fonda->location = $locationModel->findLocationById($fonda->locationId);
            $fonda->group = $fondaGroupModel->findFondaGroupById($fonda->groupId);
            $fonda->user = $this->user;

            return ResponseBuilder::build($fonda, $response, $request, 200);
        }
        catch(ResponseJsonError $jsonError){
            return ResponseBuilder::build($jsonError, $response, $request, 500);
        }



    }
}