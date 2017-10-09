<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    public function createAction()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)

        // method gets Doctrine's entity manager object, which is the most important object in Doctrine.
        // It's responsible for saving objects to, and fetching objects from, the database.
        $em = $this->getDoctrine()->getManager();

        //In this section, you instantiate and work with the $product object like any other normal PHP object.
        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        // call tells Doctrine to "manage" the $product object.
        // This does not cause a query to be made to the database.
        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        //hen the flush() method is called, Doctrine looks through all of the objects that
        // it's managing to see if they need to be persisted to the database. In this example,
        // the $product object's data doesn't exist in the database, so the entity manager
        // executes an INSERT query, creating a new row in the product table.
        $em->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    // if you have multiple entity managers, use the registry to fetch them
    public function editAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em2 = $doctrine->getManager('other_connection');
    }

    //Fetching Objects from the Database
    //Fetching an object back out of the database is even easier. For example, suppose you've
    // configured a route to display a specific Product based on its id value:
    public function showAction($productId)
    {
        //When you query for a particular type of object, you always use what's known as its "repository".
        // You can think of a repository as a PHP class whose only job is to help you fetch entities of a certain class.
        // You can access the repository object for an entity class via:
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            // query for a single product by its primary key (usually "id")
            ->find($productId);

        // dynamic method names to find a group of products based on a column value
        $products1 = $product->findByPrice(19.99);

        // find *all* products
        $products = $product->findAll();

        // query for a single product matching the given name and price
        $products2 = $product->findOneBy(
            array('name' => 'Keyboard', 'price' => 19.99)
        );

        // query for multiple products matching the given name, ordered by price
        $products3 = $product->findBy(
            array('name' => 'Keyboard'),
            array('price' => 'ASC')
        );

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        // ... do something, like pass the $product object into a template
        return $this->render('default/index1.html.twig', array('Products' => $product));
    }

    // Updating an Object. nce you've fetched an object from Doctrine, updating it is easy.
    // Suppose you have a route that maps a product id to an update action in a controller:
    public function updateAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    public function deleteAction($productId)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($productId);


        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }
        //deletes the product
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    public function queryAction($productId) {
        //If you're comfortable with SQL, then DQL should feel very natural. The biggest difference is that
        // you need to think in terms of selecting PHP objects, instead of rows in a database. For this reason,
        // you select from the AppBundle:Product entity (an optional shortcut for the AppBundle\Entity\Product class)
        // and then alias it as p.
        $em = $this->getDoctrine()
            ->getRepository(Product::class)
            // query for a single product by its primary key (usually "id")
            ->find($productId);

        // createQueryBuilder() automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $em->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', '19.99')
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getQuery();
        $products = $query->getResult();


//        $query = $em->createQuery(
//            'SELECT p
//             FROM AppBundle:Product p
//             WHERE p.price > :price
//            ORDER BY p.price ASC'
//        )->setParameter('price', 19.99);

//        $products = $query->getResult();
    }
}
