<?php
namespace Modules\Dashboard\Model;

use Model\Model;

class Dashboard extends Model
{
    /**
     * Fetch total orders count
     *
     * @return mixed
     */
    public function getTotalOrders()
    {
        $query = 'SELECT COUNT(id) as orders_count FROM `order`';

        return $this->execute($query);
    }

    /**
     * Fetch total revenue
     *
     * @return mixed
     */
    public function getTotalRevenue()
    {
        $query = 'SELECT SUM(price * quantity) / 100 as total_revenue FROM `order_items`';

        return $this->execute($query);
    }

    /**
     * Fetch total customers count
     *
     * @return mixed
     */
    public function getTotalCustomers()
    {
        $query = 'SELECT COUNT(id) as customers_count FROM `customer`';

        return $this->execute($query);
    }

    /**
     * Fetch customers top
     *
     * @param $top
     * @return mixed
     */
    public function getTopCustomers($top = 10)
    {
        $query = '
          SELECT COUNT(o.id) as orders_count, c.name, c.surname
          FROM `customer` c
          LEFT JOIN `order` o ON o.customer_id = c.id
          GROUP BY c.id
          ORDER BY orders_count DESC, c.surname ASC
          LIMIT ?
          ';

        return $this->execute($query, [$top]);
    }

    /**
     * Fetch top selling items
     *
     * @param $top
     * @return mixed
     */
    public function getTopSellingItems($top = 10)
    {
        $query = '
          SELECT SUM(oi.quantity) as items_sold, oi.ean
          FROM `order_items` oi
          GROUP BY oi.ean
          ORDER BY items_sold DESC, oi.ean ASC
          LIMIT ?
          ';

        return $this->execute($query, [$top]);
    }
}