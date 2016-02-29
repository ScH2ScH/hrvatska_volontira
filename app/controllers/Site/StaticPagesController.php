<?php

class StaticPagesController extends BaseSiteController
{

    public function show($slug = '404')
    {
        $page = StaticPage::where('active', '=', 1)->where('slug', '=', $slug)->first();

        if (empty($page)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Static page not found');
        }

        $this->setParam('page', $page);

        return $this->render('Site.StaticPages.Default');
    }

}