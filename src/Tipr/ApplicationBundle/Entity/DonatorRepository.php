<?php

namespace Tipr\ApplicationBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DonatorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DonatorRepository extends EntityRepository
{
    public function getDonationsLimit($donator, $limit)
    {
        $qb = $this->_em->createQueryBuilder();
        return $qb->select('c')
            ->from('Tipr\ApplicationBundle\Entity\Donation', 'c')
            ->where('c.donator = :donator')
            ->setParameter('donator', $donator)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getDonationsThisWeek($donator)
    {
        $start = strtotime("-1 week");
        $end = strtotime("tomorrow");

        $qb = $this->_em->createQueryBuilder();
        $donations = $qb->select('c')
            ->from('Tipr\ApplicationBundle\Entity\Donation', 'c')
            ->where('(c.date BETWEEN :start AND :end) AND c.donator = :donator')
            ->setParameter('donator', $donator)
            ->setParameter('start', date('Y-m-d', $start))
            ->setParameter('end', date('Y-m-d', $end))
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();

        $totals = array();
        foreach ($donations as $donation) {
            if (isset($totals[date_format($donation->getDate(), 'd')])) {
                $totals[date_format($donation->getDate(), 'd')] += $donation->getAmount();
            } else {
                $totals[date_format($donation->getDate(), 'd')] = $donation->getAmount();
            }
        }
        return $totals;
    }

    public function getTotalThisDay($donator)
    {
        $start = strtotime("-1 day");
        $end = strtotime("tomorrow");

        $qb = $this->_em->createQueryBuilder();
        $donations = $qb->select('c')
            ->from('Tipr\ApplicationBundle\Entity\Donation', 'c')
            ->where('(c.date BETWEEN :start AND :end) AND c.donator = :donator')
            ->setParameter('donator', $donator)
            ->setParameter('start', date('Y-m-d', $start))
            ->setParameter('end', date('Y-m-d', $end))
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();

        $total = 0;
        foreach ($donations as $donation) {
            $total += $donation->getAmount();
        }

        return $total;
    }

    public function getTotalThisWeek($donator)
    {
        $start = strtotime("-1 week");
        $end = strtotime("tomorrow");

        $qb = $this->_em->createQueryBuilder();
        $donations = $qb->select('c')
            ->from('Tipr\ApplicationBundle\Entity\Donation', 'c')
            ->where('(c.date BETWEEN :start AND :end) AND c.donator = :donator')
            ->setParameter('donator', $donator)
            ->setParameter('start', date('Y-m-d', $start))
            ->setParameter('end', date('Y-m-d', $end))
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();

        $total = 0;
        foreach ($donations as $donation) {
            $total += $donation->getAmount();
        }

        return $total;
    }

    public function getTotalThisMonth($donator)
    {
        $start = strtotime("-1 month");
        $end = strtotime("tomorrow");

        $qb = $this->_em->createQueryBuilder();
        $donations = $qb->select('c')
            ->from('Tipr\ApplicationBundle\Entity\Donation', 'c')
            ->where('(c.date BETWEEN :start AND :end) AND c.donator = :donator')
            ->setParameter('donator', $donator)
            ->setParameter('start', date('Y-m-d', $start))
            ->setParameter('end', date('Y-m-d', $end))
            ->orderBy('c.date', 'DESC')
            ->getQuery()
            ->getResult();

        $total = 0;
        foreach ($donations as $donation) {
            $total += $donation->getAmount();
        }

        return $total;
    }

}
