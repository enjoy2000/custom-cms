<?php

namespace Api\Controller;

use Zend\View\Model\JsonModel;
class IndexController extends AbstractRestfulJsonController
{
    public function getList()
    {   // Action used for GET requests without resource Id
        return new JsonModel(
            ['data' => [
                    ['id' => 1, 'name' => 'Mothership', 'band' => 'Led Zeppelin'],
                    ['id' => 2, 'name' => 'Coda',       'band' => 'Led Zeppelin'],
                ],
            ]
        );
    }

    public function get($id)
    {   // Action used for GET requests with resource Id
        return new JsonModel(['data' => ['id' => 2, 'name' => 'Coda', 'band' => 'Led Zeppelin']]);
    }

    public function create($data)
    {   // Action used for POST requests
        return new JsonModel(['data' => ['id' => 3, 'name' => 'New Album', 'band' => 'New Band']]);
    }

    public function update($id, $data)
    {   // Action used for PUT requests
        return new JsonModel(['data' => ['id' => 3, 'name' => 'Updated Album', 'band' => 'Updated Band']]);
    }

    public function delete($id)
    {   // Action used for DELETE requests
        return new JsonModel(['data' => 'album id 3 deleted']);
    }
}
