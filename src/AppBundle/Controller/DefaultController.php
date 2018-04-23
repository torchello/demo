<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("", name="homepage")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        if ($request->query->has('filter')) {
            $queryFilter = $this->get('parser.query_filter')->parse($request->query->get('filter'));
            $users = $this->getDoctrine()
                ->getRepository(User::class)
                ->getUsersByQueryFilter($queryFilter);

            return [
                'users' => $users,
            ];
        }

        return [];
    }
}
