<?php
namespace meme\Repository;
 
use Doctrine\ORM\EntityRepository;
 
class JokeRepository extends EntityRepository
{
    public function newest($limit = null, $offset = null){
        return $this->findBy(
            array(),
            array('created_at' => 'DESC'),
            $limit,
            $offset
        );
    }
    
    public function top($limit = null, $offset = null)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT j, (j.up_votes - j.down_votes) AS score
                FROM meme\Entity\Joke j
                ORDER BY score DESC 
            ')->setMaxResults($limit)
            ->setFirstResult($offset)
        ;

        try {
            $jokes = array();
            foreach($query->getResult() as $result) {
                $jokes[] = $result[0];
            }
            return $jokes;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function random()
    {
        $max_id = $this->getEntityManager()
            ->createQuery('
                SELECT MAX(j.id)
                FROM meme\Entity\Joke j
            ')->getSingleScalarResult();
        
        return $this->getEntityManager()
            ->createQuery('
                SELECT j
                FROM meme\Entity\Joke j
                WHERE j.id >= :rand 
            ')->setParameter('rand', mt_rand(0, 1000) / 1000 * $max_id)
            ->setMaxResults(1)
            ->getSingleResult();
    }
}
