<?php

namespace meme\Controller;

use Knp\Bundle\RadBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use meme\Entity\Joke;
use meme\Entity\Ban;

/**
 * Api controller.
 */
class AppController extends Controller {
    public function newest()
    {        
        return array(
            'jokes' => $this->getEntityRepository('meme\Entity\Joke')->newest(),
        );
    }
    
    public function top()
    {
        return array(
            'jokes' => $this->getEntityRepository('meme\Entity\Joke')->top(),
        );
    }
    
    public function random()
    {
        return array(
            'joke' => $this->getEntityRepository('meme\Entity\Joke')->random()
        );
    }
    
    public function submit(Request $request)
    {        
        if('POST' === $request->getMethod()) {
            $data = $request->request->all();
            
            if("" === trim($data['author'])) {
                $data['author'] = 'Anonymous';
            }
            
            $joke = new Joke(
                $data['author'],
                $data['who'],
                $data['punchline']
            );
            
            $em = $this->getEntityManager();
            $em->persist($joke);
            $em->flush();
            
            return $this->redirect($this->generateUrl('homepage'));
        } else {
            return array();
        }
    }
    
    public function about()
    {
        return array();
    }
    
    public function show($joke_id)
    {
        return array(
            'joke' => $this->getEntityManager()->find('meme\Entity\Joke', $joke_id),
        );
    }
    
    public function voteup(Request $request, $joke_id)
    {
        return $this->vote($request, $joke_id, true);
    }
    
    public function votedown(Request $request, $joke_id)
    {
        return $this->vote($request, $joke_id, false);
    }
    
    private function vote(Request $request, $joke_id, $up = true)
    {
        $em = $this->getEntityManager();
        $joke = $em->find('meme\Entity\Joke', $joke_id);
        $ip = $request->getClientIp();
        
        if(null !== $joke) {
            $banned = count(
                $this->getEntityRepository('meme\Entity\Ban')->findBy(
                    array(
                        'ip'   => $ip,
                        'joke' => $joke->getId()
                    )
                )
            ) > 0;
            
            if(!$banned) {
                if($up) {
                    $joke->upVote();
                } else {
                    $joke->downVote();
                }
                $ban = new Ban($ip, $joke);
                
                $em->persist($joke);
                $em->persist($ban);
                $em->flush();
                
                return $this->renderJson(array(
                    'status' => 'ok',
                    'votes'  => ($up) ? $joke->getUpVotes() : $joke->getDownVotes(),
                ));
            } else {
                return $this->renderJson(array(
                    'status' => 'fail',
                )); 
            }
        }
    }
}