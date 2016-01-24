<?php
namespace Modules\Dashboard\Model;

use Model\Model;

class Dashboard extends Model
{
    /**
     * Fetch total orders count
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTotalOrders($from, $to)
    {
        $query = '
          SELECT COUNT(id) as orders_count
          FROM `order`
          WHERE (purchase_date BETWEEN ? AND ?)';

        return $this->execute($query, [$from, $to]);
    }

    /**
     * Fetch total revenue
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTotalRevenue($from, $to)
    {
        $query = '
          SELECT SUM(oi.price * oi.quantity) / 100 as total_revenue
          FROM `order_items` oi
          LEFT JOIN `order` o ON o.id = oi.order_id
          WHERE (o.purchase_date BETWEEN ? AND ?)';

        $data = $this->execute($query, [$from, $to]);

        $data[0]['total_revenue'] = number_format($data[0]['total_revenue'], 2, '.', '');

        return $data;
    }

    /**
     * Fetch total customers count
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTotalCustomers($from, $to)
    {
        $query = '
          SELECT COUNT(DISTINCT o.customer_id) as customers_count
          FROM `order` o
          WHERE (o.purchase_date BETWEEN ? AND ?)';

        return $this->execute($query, [$from, $to]);
    }

    /**
     * Fetch customers top
     *
     * @param $from
     * @param $to
     * @param int $top
     * @return mixed
     */
    public function getTopCustomers($from, $to, $top = 10)
    {
        $query = '
          SELECT c.name, c.surname, COUNT(o.id) as orders_count
          FROM `customer` c
          LEFT JOIN `order` o ON o.customer_id = c.id
          WHERE (o.purchase_date BETWEEN ? AND ?)
          GROUP BY c.id
          ORDER BY orders_count DESC, c.surname ASC
          LIMIT ?
          ';

        return $this->execute($query, [$from, $to, $top]);
    }

    /**
     * Fetch top selling items
     *
     * @param $from
     * @param $to
     * @param $top
     * @return mixed
     */
    public function getTopSellingItems($from, $to, $top = 10)
    {
        $query = '
          SELECT oi.ean as EAN, SUM(oi.quantity) as items_sold
          FROM `order_items` oi
          LEFT JOIN `order` o ON o.id = oi.order_id
          WHERE (o.purchase_date BETWEEN ? AND ?)
          GROUP BY oi.ean
          ORDER BY items_sold DESC, oi.ean ASC
          LIMIT ?
          ';

        return $this->execute($query, [$from, $to, $top]);
    }

    /**
     * Fetch top orders by revenue
     *
     * @param int $top
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTopOrdersByRevenue($from, $to, $top = 10)
    {
        $query = '
          SELECT o.id as ID, FROM_UNIXTIME(o.purchase_date, \'%Y-%m-%d\') as purchase_date, SUM(oi.quantity * oi.price) / 100 as revenue
          FROM `order` o
          LEFT JOIN `order_items` oi ON o.id = oi.order_id
          WHERE (o.purchase_date BETWEEN ? AND ?)
          GROUP BY o.id
          ORDER BY revenue DESC, o.id ASC
          LIMIT ?
          ';

        $data = $this->execute($query, [$from, $to, $top]);

        foreach ($data as &$row) {
            $row['revenue'] = number_format($row['revenue'], '2', '.', '');
        }

        return $data;
    }

    /**
     * Fetch top orders by item count
     *
     * @param int $top
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTopOrdersByItemCount($from, $to, $top = 10)
    {
        $query = '
          SELECT  o.id as ID, FROM_UNIXTIME(o.purchase_date, \'%Y-%m-%d\') as purchase_date, SUM(oi.quantity) as items_count
          FROM `order` o
          LEFT JOIN `order_items` oi ON o.id = oi.order_id
          WHERE (o.purchase_date BETWEEN ? AND ?)
          GROUP BY o.id
          ORDER BY items_count DESC, o.id ASC
          LIMIT ?
          ';

        return $this->execute($query, [$from, $to, $top]);
    }

    /**
     * Fetch total orders
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTotalOrdersForChart($from, $to)
    {
        $query = '
          SELECT FROM_UNIXTIME(purchase_date, \'%Y-%m-%d\') date, COUNT(id) as orders_count
          FROM `order`
          WHERE (purchase_date BETWEEN ? AND ?)
          GROUP BY date
          ORDER BY date ASC';

        $data = $this->execute($query, [$from, $to]);

        $result = [];
        foreach ($data as $row) {
            $result[] = [
                strtotime($row['date']) * 1000,
                (int)$row['orders_count']
            ];
        }

        return $result;
    }

    /**
     * Fetch total customers
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function getTotalCustomersForChart($from, $to)
    {
        $query = '
          SELECT FROM_UNIXTIME(o.purchase_date, \'%Y-%m-%d\') date, COUNT(DISTINCT o.customer_id) as customers_count
          FROM `order` o
          WHERE (o.purchase_date BETWEEN ? AND ?)
          GROUP BY date
          ORDER BY date ASC';

        $data = $this->execute($query, [$from, $to]);

        $result = [];
        foreach ($data as $row) {
            $result[] = [
                strtotime($row['date']) * 1000,
                (int)$row['customers_count']
            ];
        }

        return $result;
    }
}