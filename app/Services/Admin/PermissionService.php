<?php

namespace App\Services\Admin;

class PermissionService
{

    const PROMO_CODES_VIEW = 'promo_codes.view';
    const PROMO_CODES_CREATE = 'promo_codes.create';
    const PROMO_CODES_EDIT = 'promo_codes.edit';
    const PROMO_CODES_DELETE = 'promo_codes.delete';

    const ORDERS_VIEW = 'orders.view';
    const ORDERS_CREATE = 'orders.create';
    const ORDERS_EDIT = 'orders.edit';
    const ORDERS_DELETE = 'orders.delete';

    const PRODUCTS_VIEW = 'products.view';
    const PRODUCTS_CREATE = 'products.create';
    const PRODUCTS_EDIT = 'products.edit';
    const PRODUCTS_DELETE = 'products.delete';

    const CATEGORIES_VIEW = 'categories.view';
    const CATEGORIES_CREATE = 'categories.create';
    const CATEGORIES_EDIT = 'categories.edit';
    const CATEGORIES_DELETE = 'categories.delete';

    const BRANDS_VIEW = 'brands.view';
    const BRANDS_CREATE = 'brands.create';
    const BRANDS_EDIT = 'brands.edit';
    const BRANDS_DELETE = 'brands.delete';

    const PROPERTIES_VIEW = 'properties.view';
    const PROPERTIES_CREATE = 'properties.create';
    const PROPERTIES_EDIT = 'properties.edit';
    const PROPERTIES_DELETE = 'properties.delete';

    const GIFTS_VIEW = 'gifts.view';
    const GIFTS_CREATE = 'gifts.create';
    const GIFTS_EDIT = 'gifts.edit';
    const GIFTS_DELETE = 'gifts.delete';

    const GIFT_CARDS_VIEW = 'gift_cards.view';
    const GIFT_CARDS_CREATE = 'gift_cards.create';
    const GIFT_CARDS_EDIT = 'gift_cards.edit';
    const GIFT_CARDS_DELETE = 'gift_cards.delete';

    const FEEDBACKS_VIEW = 'feedbacks.view';
    const FEEDBACKS_CREATE = 'feedbacks.create';
    const FEEDBACKS_EDIT = 'feedbacks.edit';
    const FEEDBACKS_DELETE = 'feedbacks.delete';

    const SUBSCRIPTIONS_VIEW = 'subscribers.view';
    const SUBSCRIPTIONS_CREATE = 'subscribers.create';
    const SUBSCRIPTIONS_EDIT = 'subscribers.edit';
    const SUBSCRIPTIONS_DELETE = 'subscribers.delete';

    const NEWS_VIEW = 'news.view';
    const NEWS_CREATE = 'news.create';
    const NEWS_EDIT = 'news.edit';
    const NEWS_DELETE = 'news.delete';

    const BANNERS_VIEW = 'banners.view';
    const BANNERS_CREATE = 'banners.create';
    const BANNERS_EDIT = 'banners.edit';
    const BANNERS_DELETE = 'banners.delete';

    const USERS_VIEW = 'users.view';
    const USERS_CREATE = 'users.create';
    const USERS_EDIT = 'users.edit';
    const USERS_DELETE = 'users.delete';

    const COMMENTS_VIEW = 'comments.view';
    const COMMENTS_CREATE = 'comments.create';
    const COMMENTS_EDIT = 'comments.edit';
    const COMMENTS_DELETE = 'comments.delete';

    const QUESTIONS_VIEW = 'questions.view';
    const QUESTIONS_CREATE = 'questions.create';
    const QUESTIONS_EDIT = 'questions.edit';
    const QUESTIONS_DELETE = 'questions.delete';

    const MENUS_VIEW = 'menus.view';
    const MENUS_CREATE = 'menus.create';
    const MENUS_EDIT = 'menus.edit';
    const MENUS_DELETE = 'menus.delete';

    const DELIVERY_METHODS_VIEW = 'delivery-methods.view';
    const DELIVERY_METHODS_EDIT = 'delivery-methods.edit';
    const DELIVERY_METHODS_DELETE = 'delivery-methods.delete';

    const CONFIG_VIEW = 'config.view';
    const CONFIG_MANAGE = 'config.manage';

    const PRODUCT_PRICES_VIEW = 'product-prices.view';
    const PRODUCT_PRICES_CREATE = 'product-prices.create';
    const PRODUCT_PRICES_EDIT = 'product-prices.edit';
    const PRODUCT_PRICES_DELETE = 'product-prices.delete';

    const PRODUCT_AVAILABILITY_WAITER_VIEW = 'product-availability-waiter.view';

    const CATALOG_BANNERS_VIEW = 'catalog-banners-view.view';
    const CATALOG_BANNERS_CREATE = 'catalog-banners-view.create';
    const CATALOG_BANNERS_EDIT = 'catalog-banners-view.edit';
    const CATALOG_BANNERS_DELETE = 'catalog-banners-view.delete';

    const CATALOG_ITEMS_VIEW = 'catalog-items.view';
    const CATALOG_ITEMS_CREATE = 'catalog-items.create';
    const CATALOG_ITEMS_EDIT = 'catalog-items.edit';
    const CATALOG_ITEMS_DELETE = 'catalog-items.delete';


    public static function getAll(): array
    {
        return [
            'Промокоды' => [
                self::PROMO_CODES_VIEW => 'Просмотр',
                self::PROMO_CODES_CREATE => 'Создание',
//                self::PROMO_CODES_EDIT => 'Редактирование',
                self::PROMO_CODES_DELETE => 'Удаление',
            ],
            'Заказы' => [
                self::ORDERS_VIEW => 'Просмотр',
                self::ORDERS_CREATE => 'Создание',
                self::ORDERS_EDIT => 'Редактирование',
                self::ORDERS_DELETE => 'Удаление',
            ],
            'Товары' => [
                self::PRODUCTS_VIEW => 'Просмотр',
                self::PRODUCTS_CREATE => 'Создание',
                self::PRODUCTS_EDIT => 'Редактирование',
                self::PRODUCTS_DELETE => 'Удаление',
            ],
            'Категории' => [
                self::CATEGORIES_VIEW => 'Просмотр',
                self::CATEGORIES_CREATE => 'Создание',
                self::CATEGORIES_EDIT => 'Редактирование',
                self::CATEGORIES_DELETE => 'Удаление',
            ],
            'Бренды' => [
                self::BRANDS_VIEW => 'Просмотр',
                self::BRANDS_CREATE => 'Создание',
                self::BRANDS_EDIT => 'Редактирование',
                self::BRANDS_DELETE => 'Удаление',
            ],
            'Характеристики' => [
                self::PROPERTIES_VIEW => 'Просмотр',
                self::PROPERTIES_CREATE => 'Создание',
                self::PROPERTIES_EDIT => 'Редактирование',
                self::PROPERTIES_DELETE => 'Удаление',
            ],
            'Подарки' => [
                self::GIFTS_VIEW => 'Просмотр',
                self::GIFTS_CREATE => 'Создание',
                self::GIFTS_EDIT => 'Редактирование',
                self::GIFTS_DELETE => 'Удаление',
            ],
            'Подарочные карты' => [
                self::GIFT_CARDS_VIEW => 'Просмотр',
                self::GIFT_CARDS_CREATE => 'Создание',
                self::GIFT_CARDS_EDIT => 'Редактирование',
                self::GIFT_CARDS_DELETE => 'Удаление',
            ],
            'Обратная связь' => [
                self::FEEDBACKS_VIEW => 'Просмотр',
                self::FEEDBACKS_CREATE => 'Создание',
                self::FEEDBACKS_EDIT => 'Редактирование',
                self::FEEDBACKS_DELETE => 'Удаление',
            ],
            'Подписки' => [
                self::SUBSCRIPTIONS_VIEW => 'Просмотр',
                self::SUBSCRIPTIONS_CREATE => 'Создание',
                self::SUBSCRIPTIONS_EDIT => 'Редактирование',
                self::SUBSCRIPTIONS_DELETE => 'Удаление',
            ],
            'Новости' => [
                self::NEWS_VIEW => 'Просмотр',
                self::NEWS_CREATE => 'Создание',
                self::NEWS_EDIT => 'Редактирование',
                self::NEWS_DELETE => 'Удаление',
            ],
            'Баннеры' => [
                self::BANNERS_VIEW => 'Просмотр',
                self::BANNERS_CREATE => 'Создание',
                self::BANNERS_EDIT => 'Редактирование',
                self::BANNERS_DELETE => 'Удаление',
            ],
            'Пользователи' => [
                self::USERS_VIEW => 'Просмотр',
//                self::USERS_CREATE => 'Создание',
                self::USERS_EDIT => 'Редактирование',
                self::USERS_DELETE => 'Удаление',
            ],
            'Комментарии > Комментарии' => [
                self::COMMENTS_VIEW => 'Просмотр',
//                self::COMMENTS_CREATE => 'Создание',
                self::COMMENTS_EDIT => 'Редактирование',
                self::COMMENTS_DELETE => 'Удаление',
            ],
            'Комментарии > Вопросы' => [
                self::QUESTIONS_VIEW => 'Просмотр',
//                self::QUESTIONS_CREATE => 'Создание',
                self::QUESTIONS_EDIT => 'Редактирование',
                self::QUESTIONS_DELETE => 'Удаление',
            ],
            'Меню (верхнее и нижнее)' => [
                self::MENUS_VIEW => 'Просмотр',
                self::MENUS_CREATE => 'Создание',
                self::MENUS_EDIT => 'Редактирование',
                self::MENUS_DELETE => 'Удаление',
            ],
            'Доставка' => [
                self::DELIVERY_METHODS_VIEW => 'Просмотр',
                self::DELIVERY_METHODS_EDIT => 'Редактирование',
                self::DELIVERY_METHODS_DELETE => 'Удаление'
            ],
            'Настройки' => [
                self::CONFIG_VIEW => 'Просмотр',
                self::CONFIG_MANAGE => 'Создание/Редактирование',
            ],
            'Модуль ценников' => [
                self::PRODUCT_PRICES_VIEW => 'Просмотр',
                self::PRODUCT_PRICES_CREATE => 'Создание',
                self::PRODUCT_PRICES_EDIT => 'Редактирование',
                self::PRODUCT_PRICES_DELETE => 'Удаление',
            ],
            'Ожидаемые товары' => [
                self::PRODUCT_AVAILABILITY_WAITER_VIEW => 'Просмотр',
            ],
            'Баннеры в каталоге' => [
                self::CATALOG_BANNERS_VIEW => 'Просмотр',
                self::CATALOG_BANNERS_CREATE => 'Создание',
                self::CATALOG_BANNERS_EDIT => 'Редактирование',
                self::CATALOG_BANNERS_DELETE => 'Удаление',
            ],
            'Главный каталог' => [
                self::CATALOG_ITEMS_VIEW => 'Просмотр',
                self::CATALOG_ITEMS_CREATE => 'Создание',
                self::CATALOG_ITEMS_EDIT => 'Редактирование',
                self::CATALOG_ITEMS_DELETE => 'Удаление',
            ],
        ];
    }

}
