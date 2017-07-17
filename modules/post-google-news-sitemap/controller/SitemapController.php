<?php
/**
 * Post google sitemap controller
 * @package post-google-news-sitemap
 * @version 0.0.1
 * @upgrade true
 */

namespace PostGoogleNewsSitemap\Controller;
use Post\Model\Post as Post;

class SitemapController extends \SiteController
{
    public function indexAction(){
        $lastday = date('Y-m-d H:i:s', strtotime('-1 days'));
        $last_update = strtotime('-350 days');
        
        $posts = Post::get([
            'updated >= :updated AND status = 4 AND schema_type IN :types',
            'bind' => [
                'updated' => $lastday,
                'types' => ['Blog', 'OpEd', 'Opinion', 'PressRelease', 'Satire', 'UserGenerated', 'NewsArticle', 'Article']
            ]
        ], true);
        
        $params = [
            'posts' => []
        ];
        
        if($posts){
            $params['posts'] = \Formatter::formatMany('post', $posts, false, ['user']);
            foreach($params['posts'] as $post){
                if($post->updated->time > $last_update)
                    $last_update = $post->updated->time;
            }
        }
        
        $this->res->addHeader('Content-Type', 'application/xml; charset=UTF-8');
        $this->res->addHeader('Last-Modified', gmdate('D, d M Y H:i:s', $last_update) . ' GMT');
        $this->respond('post/google-news/index', $params, null);
    }
}