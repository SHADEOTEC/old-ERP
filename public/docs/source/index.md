---
title: API Reference

language_tabs:
- bash
- javascript
- php

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Cart management


APIs for managing carts
<!-- START_96f221c056c013ad5a17c0ab353709ea -->
## api/v3/products
> Example request:

```bash
curl -X GET -G "/api/v3/products" 
```

```javascript
const url = new URL("/api/v3/products");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "id": 50,
        "name": "DUO SHADES - BASIC COLLECTION",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 22,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635952385-Lovers-Shade-020.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "duo,light,filtering",
        "description": "<p>Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p>",
        "specification": "<p>Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p>",
        "unit_price": 10,
        "purchase_price": 10,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Light Filtering Duo",
        "meta_description": "Quisque scelerisque quis purus non accumsan. Praesent interdum, urna et hendrerit vulputate, turpis velit vestibulum odio, quis porta lectus lorem non purus.",
        "meta_img": null,
        "pdf": null,
        "slug": "Light-Filtering-Duo-3uetA",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-24 16:48:52",
        "updated_at": "2022-08-22 07:12:38",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "duo_lfc",
        "desc": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
        "category": {
            "id": 22,
            "parent_id": 2,
            "price_tag": 0,
            "level": 2,
            "name": "BASIC COLLECTION",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "BASIC-COLLECTION-LMsDN",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-14 18:53:36",
            "updated_at": "2021-12-14 18:53:36",
            "parentCategory": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            },
            "parent_category": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            }
        }
    },
    {
        "id": 60,
        "name": "DUO SHADES - LIGHT FILTERING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 9,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635357509-duo-shadeLight Filtering Collections.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p>",
        "specification": "<p>Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "luxe collection",
        "meta_description": "luxe collection",
        "meta_img": null,
        "pdf": null,
        "slug": "luxe-collection-9vpFc",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-27 17:58:29",
        "updated_at": "2022-08-30 07:44:59",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "duo_luxe",
        "desc": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
        "category": {
            "id": 9,
            "parent_id": 2,
            "price_tag": 0,
            "level": 2,
            "name": "LUXE COLLECTION",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "luxe-collections-kvqgj",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:23:24",
            "updated_at": "2021-12-16 02:23:24",
            "parentCategory": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            },
            "parent_category": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            }
        }
    },
    {
        "id": 72,
        "name": "DUO SHEER SHADES - ROOM DIMMING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 10,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1640581791.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Duo Sheer Horizontal Shades feature both light-filtering and room-darkening fabrics. These dual-layered Sheer fabrics overlap and alternate to ensure adequate darkening and privacy.<\/p>",
        "specification": "<p>Duo Sheer Horizontal Shades feature both light-filtering and room-darkening fabrics. These dual-layered Sheer fabrics overlap and alternate to ensure adequate darkening and privacy.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Room Dimming",
        "meta_description": "Room dimming",
        "meta_img": null,
        "pdf": null,
        "slug": "Room-Dimming-ZcjQU",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-13 13:07:12",
        "updated_at": "2022-01-01 00:16:37",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "duo_rdc",
        "desc": "Duo Sheer Horizontal Shades feature both light-filtering and room-darkening fabrics. These dual-layered Sheer fabrics overlap and alternate to ensure adequate darkening and privacy.",
        "category": {
            "id": 10,
            "parent_id": 2,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DIMMING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-dimming-collection-dyjfu",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:22:47",
            "updated_at": "2021-12-16 02:22:47",
            "parentCategory": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            },
            "parent_category": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            }
        }
    },
    {
        "id": 76,
        "name": "ROLLER SHADE- SUN SCREEN COLLECTION",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 13,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1640715161.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Roller shades are perfect if you’re looking to stay within a tight budget and you want added style and dependable functionality.&nbsp;<\/p>",
        "specification": "<p>Roller shades are perfect if you’re looking to stay within a tight budget and you want added style and dependable functionality.&nbsp;<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "ROLLER SHADE- Sun Screen Collection",
        "meta_description": "ROLLER SHADE- Sun Screen Collection",
        "meta_img": null,
        "pdf": null,
        "slug": "ROLLER-SHADE--Sun-Screen-Collection-IbVZZ",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-18 12:26:02",
        "updated_at": "2022-02-03 08:45:06",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "roller_sunscreen",
        "desc": "Roller shades are perfect if you’re looking to stay within a tight budget and you want added style and dependable functionality.&nbsp;",
        "category": {
            "id": 13,
            "parent_id": 3,
            "price_tag": 0,
            "level": 2,
            "name": "SUN SCREEN",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "sunscreen-collection-tujbt",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:25:28",
            "updated_at": "2021-12-16 02:25:28",
            "parentCategory": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            },
            "parent_category": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            }
        }
    },
    {
        "id": 57,
        "name": "ROLLER SHADES - LIGHT FILTERING PATTERN COLLECTION",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 15,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635329185-roller-shade.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "roller",
        "description": "<p>Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p><p><br><\/p><p><br><\/p>",
        "specification": "<p>Possibilities are endless<\/p><p>Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.&nbsp;<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Light Pattern",
        "meta_description": "Vestibulum imperdiet justo vitae dolor suscipit lobortis. Morbi feugiat ante a ipsum fermentum vestibulum. In hac habitasse platea dictumst.",
        "meta_img": null,
        "pdf": null,
        "slug": "Light-Pattern-Xr3nG",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-27 10:06:25",
        "updated_at": "2021-11-19 05:51:29",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "roller_lightpatt",
        "desc": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
        "category": {
            "id": 15,
            "parent_id": 3,
            "price_tag": 0,
            "level": 2,
            "name": "LIGHT FILTERING PATTERN",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "light-filtering-pattern-collection-uycpp",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:26:49",
            "updated_at": "2021-12-16 02:26:49",
            "parentCategory": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            },
            "parent_category": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            }
        }
    },
    {
        "id": 77,
        "name": "ROLLER SHADES - LIGHT FILTERING PLAIN COLLECTIONS",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 14,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1640995704.jpg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional light filtering materials that include solids, textures and prints.<\/p>",
        "specification": "<p>Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional light filtering materials that include solids, textures and prints.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Roller SHADES - Light Filtering Plain Collection",
        "meta_description": "Roller SHADES - Light Filtering Plain Collection",
        "meta_img": null,
        "pdf": null,
        "slug": "Roller-SHADES---Light-Filtering-Plain-Collection-TTj2h",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-18 12:28:34",
        "updated_at": "2022-01-24 06:00:41",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "roller_lightplain",
        "desc": "Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional light filtering materials that include solids, textures and prints.",
        "category": {
            "id": 14,
            "parent_id": 3,
            "price_tag": 0,
            "level": 2,
            "name": "LIGHT FILTERING PLAIN",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "light-filtering-plain-collection-oo16p",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:26:01",
            "updated_at": "2021-12-16 02:26:01",
            "parentCategory": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            },
            "parent_category": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            }
        }
    },
    {
        "id": 75,
        "name": "ROLLER SHADES - ROOM DARKENING COLLECTIONS",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 12,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1638459164-Commercial.jpg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional blackout materials that include solids, textures and prints.<\/p>",
        "specification": "<p>Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional blackout materials that include solids, textures and prints.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Roller SHADES - Darkening Pattern",
        "meta_description": "Roller SHADES - Darkening Pattern&nbsp;",
        "meta_img": null,
        "pdf": null,
        "slug": "Roller-SHADES---Darkening-Pattern-2mgM6",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-18 12:20:10",
        "updated_at": "2022-01-24 06:54:50",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "roller_darkpatt",
        "desc": "Sleek, clean and easy. Our Roller Shades add color, texture and pattern to your home. Choose from exceptional blackout materials that include solids, textures and prints.",
        "category": {
            "id": 12,
            "parent_id": 3,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DARKENING PATTERN",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-darkening-pattern-collection-kxx1a",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:24:52",
            "updated_at": "2021-12-16 02:24:52",
            "parentCategory": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            },
            "parent_category": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            }
        }
    },
    {
        "id": 61,
        "name": "ROLLER SHADES - SOLID ROOM DARKENING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 11,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635951517-Roller lf .jpg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p><p><br><\/p><p>&nbsp;<\/p>",
        "specification": "<p>Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p><p><br><\/p><p>&nbsp;<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Room Darkening Solid COllection",
        "meta_description": "Room Darkening Solid collection",
        "meta_img": null,
        "pdf": null,
        "slug": "Room-Darkening-Solid-COllection-GU5xe",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-28 06:13:30",
        "updated_at": "2021-11-13 20:55:27",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "roller_darksolid",
        "desc": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.&nbsp;",
        "category": {
            "id": 11,
            "parent_id": 3,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DARKENING SOLID",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-darkening-solid-collection-cstld",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:24:03",
            "updated_at": "2021-12-16 02:24:03",
            "parentCategory": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            },
            "parent_category": {
                "id": 3,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "ROLLER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "7",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "roller-9mbbl",
                "meta_title": "Roller Shades",
                "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:56",
                "updated_at": "2022-02-04 04:08:56"
            }
        }
    },
    {
        "id": 68,
        "name": "TRI SHADES - LIGHT FILTERING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 17,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635952152-Screen Shot 2021-11-03 at 10.08.52 AM.jpg",
        "video_provider": null,
        "video_link": null,
        "tags": "light filtering,SH-3063-12,SH3063-11,SH-3074-1,SH-3074-2,Not Listed",
        "description": "<p>Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.&nbsp;<\/p>",
        "specification": "<p>Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Light filtering collections",
        "meta_description": "Light filtering collection for tri",
        "meta_img": null,
        "pdf": null,
        "slug": "Light-filtering-collections-1wBsl",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-29 13:30:11",
        "updated_at": "2022-04-21 06:55:04",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "tri_lfc",
        "desc": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.&nbsp;",
        "category": {
            "id": 17,
            "parent_id": 5,
            "price_tag": 0,
            "level": 2,
            "name": "LIGHT FILTERING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "light-filtering-collection-ia5a3",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:28:14",
            "updated_at": "2021-12-16 02:28:14",
            "parentCategory": {
                "id": 5,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "TRI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "19",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "tri-hilbm",
                "meta_title": "Tri Shades",
                "meta_description": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:09:03",
                "updated_at": "2022-02-04 04:09:03"
            },
            "parent_category": {
                "id": 5,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "TRI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "19",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "tri-hilbm",
                "meta_title": "Tri Shades",
                "meta_description": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:09:03",
                "updated_at": "2022-02-04 04:09:03"
            }
        }
    },
    {
        "id": 67,
        "name": "TRI SHADES ROOM DIMMING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 18,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635512551-tri-shade.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "tri,roomdim",
        "description": "<p>Suspendisse potenti. Nulla viverra, tellus nec varius venenatis, libero libero sodales lectus, at maximus purus diam nec risus. Aenean mi risus, bibendum quis aliquet sit amet, fringilla elementum purus.<\/p>",
        "specification": "<p>Donec nec varius erat, at vestibulum mauris. Nulla facilisi. Mauris vestibulum elit eu dui lacinia, non sollicitudin odio placerat. Ut nec eros risus.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Room Dimming Tri",
        "meta_description": "Suspendisse potenti. Nulla viverra, tellus nec varius venenatis, libero libero sodales lectus, at maximus purus diam nec risus. Aenean mi risus, bibendum quis aliquet sit amet, fringilla elementum purus.",
        "meta_img": null,
        "pdf": null,
        "slug": "Room-Dimming-Tri-iSEfq",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-29 13:02:31",
        "updated_at": "2022-04-21 01:47:26",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "tri_rdc",
        "desc": "Suspendisse potenti. Nulla viverra, tellus nec varius venenatis, libero libero sodales lectus, at maximus purus diam nec risus. Aenean mi risus, bibendum quis aliquet sit amet, fringilla elementum purus.",
        "category": {
            "id": 18,
            "parent_id": 5,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DIMMING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-dimming-collection-1zton",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:28:57",
            "updated_at": "2021-12-16 02:28:57",
            "parentCategory": {
                "id": 5,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "TRI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "19",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "tri-hilbm",
                "meta_title": "Tri Shades",
                "meta_description": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:09:03",
                "updated_at": "2022-02-04 04:09:03"
            },
            "parent_category": {
                "id": 5,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "TRI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "19",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "tri-hilbm",
                "meta_title": "Tri Shades",
                "meta_description": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:09:03",
                "updated_at": "2022-02-04 04:09:03"
            }
        }
    },
    {
        "id": 69,
        "name": "UNI SHADES - LIGHT FILTERING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 16,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635952574-galaxy-blinds (1).jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "UNI SHADES",
        "description": "<p>Uni Shades provide an elegant drapery look with ultimate functionality. They enable you to access your patio with ease, although they look unified the fabric is actually divided so you can walk through easily.<\/p>",
        "specification": "<p>Unishades create a unified look to complete the entrance to your patio. It can also be used as a luxurious and eco-friendly room divider.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "UNI SHADES",
        "meta_description": "Unishades create a unified look to complete the entrance to your patio. It can also be used as a luxurious and eco-friendly room divider.",
        "meta_img": null,
        "pdf": null,
        "slug": "UNI-SHADES-L1UzF",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-03 15:16:14",
        "updated_at": "2022-01-01 00:13:54",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "uni",
        "desc": "Uni Shades provide an elegant drapery look with ultimate functionality. They enable you to access your patio with ease, although they look unified the fabric is actually divided so you can walk through easily.",
        "category": {
            "id": 16,
            "parent_id": 4,
            "price_tag": 0,
            "level": 2,
            "name": "UNI SHADES",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "uni-shade-collection-rlpm6",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:27:33",
            "updated_at": "2021-12-16 02:27:33",
            "parentCategory": {
                "id": 4,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "UNI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "38",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "uni-ohf0g",
                "meta_title": "Uni Shades",
                "meta_description": "Uni Shades create a unified look to complete the entrance to your patio. It can also be used as a luxurious and eco-friendly room divider.",
                "created_at": "2022-02-03 21:09:04",
                "updated_at": "2022-02-04 04:09:04"
            },
            "parent_category": {
                "id": 4,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "UNI SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "38",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "uni-ohf0g",
                "meta_title": "Uni Shades",
                "meta_description": "Uni Shades create a unified look to complete the entrance to your patio. It can also be used as a luxurious and eco-friendly room divider.",
                "created_at": "2022-02-03 21:09:04",
                "updated_at": "2022-02-04 04:09:04"
            }
        }
    },
    {
        "id": 56,
        "name": "WILLOW SHADES - LIGHT FILTERING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 19,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1635320187-willow-shade.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "willow,light",
        "description": "<p>Willow Shades complements your gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.<\/p>",
        "specification": "<p>Willow Shades complements your gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Light Filtering",
        "meta_description": "Nulla eu ornare purus. Donec vel mauris leo.",
        "meta_img": null,
        "pdf": null,
        "slug": "Light-Filtering-DGSjD",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-10-27 07:36:27",
        "updated_at": "2021-11-13 20:52:02",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "willow_lfc",
        "desc": "Willow Shades complements your gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
        "category": {
            "id": 19,
            "parent_id": 6,
            "price_tag": 0,
            "level": 2,
            "name": "LIGHT FILTERING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "light-filtering-collection-u5ugb",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:29:40",
            "updated_at": "2021-12-16 02:29:40",
            "parentCategory": {
                "id": 6,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "WILLOW SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "39",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "willow-vrady",
                "meta_title": "Willow Shades",
                "meta_description": "Willow Shades complements gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
                "created_at": "2021-11-05 20:02:46",
                "updated_at": "2021-11-05 15:02:46"
            },
            "parent_category": {
                "id": 6,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "WILLOW SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "39",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "willow-vrady",
                "meta_title": "Willow Shades",
                "meta_description": "Willow Shades complements gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
                "created_at": "2021-11-05 20:02:46",
                "updated_at": "2021-11-05 15:02:46"
            }
        }
    },
    {
        "id": 74,
        "name": "WILLOW SHADES - Room Dimming Collection",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 20,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1637235102-duo-shadeLight Filtering Collections.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Combining the luxury of sheer draperies with the function of vertical blinds is what makes the Willow Shades special.<\/p>",
        "specification": "<p>Combining the luxury of sheer draperies with the function of vertical blinds is what makes the Willow Shades special.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "WILLOW SHADES - Room Dimming Collection",
        "meta_description": "WILLOW SHADES - Room Dimming Collection",
        "meta_img": null,
        "pdf": null,
        "slug": "WILLOW-SHADES---Room-Dimming-Collection-vCfgb",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-18 11:31:42",
        "updated_at": "2022-01-01 00:12:49",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "willow_rdc",
        "desc": "Combining the luxury of sheer draperies with the function of vertical blinds is what makes the Willow Shades special.",
        "category": {
            "id": 20,
            "parent_id": 6,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DIMMING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-dimming-collection-qazdg",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:31:03",
            "updated_at": "2021-12-16 02:31:03",
            "parentCategory": {
                "id": 6,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "WILLOW SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "39",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "willow-vrady",
                "meta_title": "Willow Shades",
                "meta_description": "Willow Shades complements gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
                "created_at": "2021-11-05 20:02:46",
                "updated_at": "2021-11-05 15:02:46"
            },
            "parent_category": {
                "id": 6,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "WILLOW SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "39",
                "icon": null,
                "featured": 0,
                "top": 0,
                "digital": 0,
                "slug": "willow-vrady",
                "meta_title": "Willow Shades",
                "meta_description": "Willow Shades complements gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
                "created_at": "2021-11-05 20:02:46",
                "updated_at": "2021-11-05 15:02:46"
            }
        }
    }
]
```

### HTTP Request
`GET api/v3/products`


<!-- END_96f221c056c013ad5a17c0ab353709ea -->

<!-- START_3fefa1d25e01b547a27fae8b7abb5feb -->
## Get all data for product to create a cart item.

This route get product_id and seller_id as input send back data which can be used for creating a new cart item.
 Response is a JSON includes following sections.

<b>product</b>       --Current products of cart

<b>categories</b>    --List of all categories present in system. List include parent categories as top level which include child categories as sub list.

<b>tags</b>          --Array of tags associated with product

<b>fabric</b>        --List of fabric associated with products

<b>price_cat</b>     --Current prouduct category object

<b>price_arr</b>     --Two dimensional array includes price data according to each possible width and height

<b>distinct_wid</b>  --List of numbers associated with current product category

<b>distinct_len</b>  --List of numbers associated with current product category

<b>fabric_all</b>    --All fabric present in system

<b>shade_opt</b>     --All shade options list associated with current category

<b>fab_opt</b>       --All fabric options list associated with current category

<b>coupon_arr</b>    --List of coupons whose end date greater then today

<b>cust_discount</b> --Seller discount object according to seller_id URI parameter

<b>destinations</b>  --All destination, an associative array of {country, country_code}

<b>roomtype</b>      --List of rooms sorted by name

<b>mount</b>

<b>cassette</b>

<b>bracket</b>

<b>springassist</b>

<b>wrap</b>

<b>stack</b>

<b>mountpos</b>

<b>controltype</b>

<b>ct_manuals</b>

<b>ct_motors</b>

<b>ct_wid_motors</b>

<b>wid_motor_max</b>

<b>invoice</b>       --Lates order number

]

> Example request:

```bash
curl -X GET -G "/api/v3/cart/1/1" 
```

```javascript
const url = new URL("/api/v3/cart/1/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Invalid Product Id 1"
}
```
> Example response (200):

```json
{
    "product": {
        "id": 72,
        "name": "DUO SHEER SHADES - ROOM DIMMING",
        "added_by": "admin",
        "user_id": 9,
        "category_id": 10,
        "brand_id": null,
        "photos": null,
        "thumbnail_img": "1640581791.jpeg",
        "video_provider": null,
        "video_link": null,
        "tags": "",
        "description": "<p>Duo Sheer Horizontal Shades feature both light-filtering and room-darkening fabrics. These dual-layered Sheer fabrics overlap and alternate to ensure adequate darkening and privacy.<\/p>",
        "specification": "<p>Duo Sheer Horizontal Shades feature both light-filtering and room-darkening fabrics. These dual-layered Sheer fabrics overlap and alternate to ensure adequate darkening and privacy.<\/p>",
        "unit_price": 0,
        "purchase_price": null,
        "variant_product": 0,
        "attributes": "[]",
        "choice_options": null,
        "colors": null,
        "variations": null,
        "todays_deal": 0,
        "published": 1,
        "approved": 1,
        "stock_visibility_state": "quantity",
        "cash_on_delivery": 1,
        "featured": 0,
        "seller_featured": 0,
        "current_stock": 0,
        "unit": null,
        "min_qty": 1,
        "low_stock_quantity": null,
        "discount": null,
        "discount_type": null,
        "discount_start_date": null,
        "discount_end_date": null,
        "tax": null,
        "tax_type": null,
        "shipping_type": "flat_rate",
        "shipping_cost": null,
        "is_quantity_multiplied": 0,
        "est_shipping_days": null,
        "num_of_sale": 0,
        "meta_title": "Room Dimming",
        "meta_description": "Room dimming",
        "meta_img": null,
        "pdf": null,
        "slug": "Room-Dimming-ZcjQU",
        "rating": 0,
        "barcode": null,
        "digital": 0,
        "file_name": null,
        "file_path": null,
        "created_at": "2021-11-13 13:07:12",
        "updated_at": "2022-01-01 00:16:37",
        "state": "Active",
        "archived": 0,
        "is_parts": 0,
        "part_code": null,
        "shade_code": "duo_rdc",
        "category": {
            "id": 10,
            "parent_id": 2,
            "price_tag": 0,
            "level": 2,
            "name": "ROOM DIMMING",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "room-dimming-collection-dyjfu",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-16 07:22:47",
            "updated_at": "2021-12-16 02:22:47",
            "parent_category": {
                "id": 2,
                "parent_id": 1,
                "price_tag": 0,
                "level": 1,
                "name": "DUO SHEER SHADES",
                "order_level": 0,
                "commision_rate": 0,
                "banner": "40",
                "icon": null,
                "featured": 1,
                "top": 0,
                "digital": 0,
                "slug": "duo-laxiv",
                "meta_title": "Duo Shades",
                "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                "created_at": "2022-02-03 21:08:51",
                "updated_at": "2022-02-04 04:08:51"
            }
        }
    },
    "categories": [
        {
            "id": 1,
            "parent_id": 0,
            "price_tag": 0,
            "level": 0,
            "name": "SHADES",
            "order_level": 0,
            "commision_rate": 0,
            "banner": null,
            "icon": null,
            "featured": 0,
            "top": 0,
            "digital": 0,
            "slug": "shades-hjohl",
            "meta_title": null,
            "meta_description": null,
            "created_at": "2021-12-14 23:53:54",
            "updated_at": "2021-12-14 18:53:54",
            "children_categories": [
                {
                    "id": 2,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "DUO SHEER SHADES",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": "40",
                    "icon": null,
                    "featured": 1,
                    "top": 0,
                    "digital": 0,
                    "slug": "duo-laxiv",
                    "meta_title": "Duo Shades",
                    "meta_description": "Duo Sheer provides an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                    "created_at": "2022-02-03 21:08:51",
                    "updated_at": "2022-02-04 04:08:51",
                    "categories": [
                        {
                            "id": 8,
                            "parent_id": 2,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LIGHT FILTERING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "light-filtering-collection-leroo",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:22:14",
                            "updated_at": "2021-12-16 02:22:14"
                        },
                        {
                            "id": 9,
                            "parent_id": 2,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LUXE COLLECTION",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "luxe-collections-kvqgj",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:23:24",
                            "updated_at": "2021-12-16 02:23:24"
                        },
                        {
                            "id": 10,
                            "parent_id": 2,
                            "price_tag": 0,
                            "level": 2,
                            "name": "ROOM DIMMING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "room-dimming-collection-dyjfu",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:22:47",
                            "updated_at": "2021-12-16 02:22:47"
                        },
                        {
                            "id": 22,
                            "parent_id": 2,
                            "price_tag": 0,
                            "level": 2,
                            "name": "BASIC COLLECTION",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "BASIC-COLLECTION-LMsDN",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-14 18:53:36",
                            "updated_at": "2021-12-14 18:53:36"
                        }
                    ]
                },
                {
                    "id": 3,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "ROLLER SHADES",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": "7",
                    "icon": null,
                    "featured": 1,
                    "top": 0,
                    "digital": 0,
                    "slug": "roller-9mbbl",
                    "meta_title": "Roller Shades",
                    "meta_description": "Roller Shades provide a simplistic and modern look, they come in a variety of fabrics ranging from light filtering to 100% blackout. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                    "created_at": "2022-02-03 21:08:56",
                    "updated_at": "2022-02-04 04:08:56",
                    "categories": [
                        {
                            "id": 11,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "ROOM DARKENING SOLID",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "room-darkening-solid-collection-cstld",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:24:03",
                            "updated_at": "2021-12-16 02:24:03"
                        },
                        {
                            "id": 12,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "ROOM DARKENING PATTERN",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "room-darkening-pattern-collection-kxx1a",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:24:52",
                            "updated_at": "2021-12-16 02:24:52"
                        },
                        {
                            "id": 13,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "SUN SCREEN",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "sunscreen-collection-tujbt",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:25:28",
                            "updated_at": "2021-12-16 02:25:28"
                        },
                        {
                            "id": 14,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LIGHT FILTERING PLAIN",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "light-filtering-plain-collection-oo16p",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:26:01",
                            "updated_at": "2021-12-16 02:26:01"
                        },
                        {
                            "id": 15,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LIGHT FILTERING PATTERN",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "light-filtering-pattern-collection-uycpp",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:26:49",
                            "updated_at": "2021-12-16 02:26:49"
                        },
                        {
                            "id": 23,
                            "parent_id": 3,
                            "price_tag": 0,
                            "level": 2,
                            "name": "Random Collection",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "Random-Collection-EsoOw",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2022-02-07 22:15:11",
                            "updated_at": "2022-02-07 22:15:11"
                        }
                    ]
                },
                {
                    "id": 4,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "UNI SHADES",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": "38",
                    "icon": null,
                    "featured": 0,
                    "top": 0,
                    "digital": 0,
                    "slug": "uni-ohf0g",
                    "meta_title": "Uni Shades",
                    "meta_description": "Uni Shades create a unified look to complete the entrance to your patio. It can also be used as a luxurious and eco-friendly room divider.",
                    "created_at": "2022-02-03 21:09:04",
                    "updated_at": "2022-02-04 04:09:04",
                    "categories": [
                        {
                            "id": 16,
                            "parent_id": 4,
                            "price_tag": 0,
                            "level": 2,
                            "name": "UNI SHADES",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "uni-shade-collection-rlpm6",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:27:33",
                            "updated_at": "2021-12-16 02:27:33"
                        }
                    ]
                },
                {
                    "id": 5,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "TRI SHADES",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": "19",
                    "icon": null,
                    "featured": 1,
                    "top": 0,
                    "digital": 0,
                    "slug": "tri-hilbm",
                    "meta_title": "Tri Shades",
                    "meta_description": "Tri Shades provide an elegant and sophisticated look to any window. Our exclusive ShadeFabrics come in a vast selection of colors with optional fire retardant and dust replant options.",
                    "created_at": "2022-02-03 21:09:03",
                    "updated_at": "2022-02-04 04:09:03",
                    "categories": [
                        {
                            "id": 17,
                            "parent_id": 5,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LIGHT FILTERING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "light-filtering-collection-ia5a3",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:28:14",
                            "updated_at": "2021-12-16 02:28:14"
                        },
                        {
                            "id": 18,
                            "parent_id": 5,
                            "price_tag": 0,
                            "level": 2,
                            "name": "ROOM DIMMING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "room-dimming-collection-1zton",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:28:57",
                            "updated_at": "2021-12-16 02:28:57"
                        }
                    ]
                },
                {
                    "id": 6,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "WILLOW SHADES",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": "39",
                    "icon": null,
                    "featured": 0,
                    "top": 0,
                    "digital": 0,
                    "slug": "willow-vrady",
                    "meta_title": "Willow Shades",
                    "meta_description": "Willow Shades complements gorgeous patio view. It’s meticulously designed to provide ultimate easy access to and from the patio. Our exclusive ShadeFabrics come in a vast selection of colors with optional dust replant options.",
                    "created_at": "2021-11-05 20:02:46",
                    "updated_at": "2021-11-05 15:02:46",
                    "categories": [
                        {
                            "id": 19,
                            "parent_id": 6,
                            "price_tag": 0,
                            "level": 2,
                            "name": "LIGHT FILTERING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "light-filtering-collection-u5ugb",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:29:40",
                            "updated_at": "2021-12-16 02:29:40"
                        },
                        {
                            "id": 20,
                            "parent_id": 6,
                            "price_tag": 0,
                            "level": 2,
                            "name": "ROOM DIMMING",
                            "order_level": 0,
                            "commision_rate": 0,
                            "banner": null,
                            "icon": null,
                            "featured": 0,
                            "top": 0,
                            "digital": 0,
                            "slug": "room-dimming-collection-qazdg",
                            "meta_title": null,
                            "meta_description": null,
                            "created_at": "2021-12-16 07:31:03",
                            "updated_at": "2021-12-16 02:31:03"
                        }
                    ]
                },
                {
                    "id": 21,
                    "parent_id": 1,
                    "price_tag": 0,
                    "level": 1,
                    "name": "Zip Track",
                    "order_level": 0,
                    "commision_rate": 0,
                    "banner": null,
                    "icon": null,
                    "featured": 0,
                    "top": 0,
                    "digital": 0,
                    "slug": "Zip-Track-xF8HH",
                    "meta_title": null,
                    "meta_description": null,
                    "created_at": "2021-11-22 01:21:26",
                    "updated_at": "2021-11-22 01:21:26",
                    "categories": []
                }
            ]
        }
    ],
    "tags": null,
    "fabric": [
        {
            "id": 1592,
            "product_id": 72,
            "fabric_id": 40,
            "xztfabric": {
                "id": 40,
                "name": "SH-3071-02",
                "fab_code": "SH-3071-02",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1638897420-24AD6D4C-AD3C-4EB2-A734-965FA11A1EE0.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2021-12-07 17:17:00",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1593,
            "product_id": 72,
            "fabric_id": 194,
            "xztfabric": {
                "id": 194,
                "name": "FLORENCE-4-DK GREY",
                "fab_code": "SH-Florence-4-DK.Grey",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1640581075.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2021-12-27 04:57:55",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1594,
            "product_id": 72,
            "fabric_id": 195,
            "xztfabric": {
                "id": 195,
                "name": "FLORENCE-3-GREY",
                "fab_code": "SH-FLORENCE-3-GREY",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1640581141.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2021-12-27 04:59:01",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1595,
            "product_id": 72,
            "fabric_id": 219,
            "xztfabric": {
                "id": 219,
                "name": "CHALANT-1-GREY",
                "fab_code": "SH-Chalant-1-Grey",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641829552.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:45:52",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1596,
            "product_id": 72,
            "fabric_id": 220,
            "xztfabric": {
                "id": 220,
                "name": "CHALANT-3-MUSHROOM",
                "fab_code": "SH-Chalant-3-Mushroom",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641829673.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:47:53",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1597,
            "product_id": 72,
            "fabric_id": 221,
            "xztfabric": {
                "id": 221,
                "name": "CHALANT-8-DK GREY",
                "fab_code": "SH-Chalant-8-DK Grey",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641829839.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:50:39",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1598,
            "product_id": 72,
            "fabric_id": 222,
            "xztfabric": {
                "id": 222,
                "name": "CHALANT-2-WHITE",
                "fab_code": "SH-Chalant-2-White",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641829934.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:52:14",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1599,
            "product_id": 72,
            "fabric_id": 223,
            "xztfabric": {
                "id": 223,
                "name": "GENOVA-2-WHITE",
                "fab_code": "SH-Genova-2-White",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641830210.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:56:50",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1600,
            "product_id": 72,
            "fabric_id": 224,
            "xztfabric": {
                "id": 224,
                "name": "GENOVA-4-MUSHROOM",
                "fab_code": "SH-Genova-4-Mushroom",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641830304.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 15:58:24",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1601,
            "product_id": 72,
            "fabric_id": 225,
            "xztfabric": {
                "id": 225,
                "name": "GENOVA-1-GREY",
                "fab_code": "SH-Genova-1-Grey",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641830553.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 16:02:33",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1602,
            "product_id": 72,
            "fabric_id": 226,
            "xztfabric": {
                "id": 226,
                "name": "GENOVA-5-DK GREY",
                "fab_code": "SH-Genova-5-DK-Grey",
                "fab_specs": "ROOM DIMMING",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641830631.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 16:03:51",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1603,
            "product_id": 72,
            "fabric_id": 237,
            "xztfabric": {
                "id": 237,
                "name": "SWIFT-1-WHITE",
                "fab_code": "SH-Swift-1-White",
                "fab_specs": "Room Dimming",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641832340.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 16:32:20",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1604,
            "product_id": 72,
            "fabric_id": 238,
            "xztfabric": {
                "id": 238,
                "name": "SWIFT-3-SAND",
                "fab_code": "SH-SWIFT-3-SAND",
                "fab_specs": "Room Dimming",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641832586.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 16:36:26",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1605,
            "product_id": 72,
            "fabric_id": 239,
            "xztfabric": {
                "id": 239,
                "name": "SWIFT-4-LT Grey",
                "fab_code": "SH-SWIFT-4-LT Grey",
                "fab_specs": "Room Dimming",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641832679.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 16:37:59",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1606,
            "product_id": 72,
            "fabric_id": 252,
            "xztfabric": {
                "id": 252,
                "name": "FLORENCE-2-Ivory",
                "fab_code": "SH-Florence-2-Ivory",
                "fab_specs": "Room Dimming",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641845607.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 20:13:27",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1607,
            "product_id": 72,
            "fabric_id": 253,
            "xztfabric": {
                "id": 253,
                "name": "FLORENCE-5-Charcoal",
                "fab_code": "SH-Florence-5-Charcoal",
                "fab_specs": "Room Dimming",
                "shade_cat": 2,
                "shade_subcat": 10,
                "url": "1641845720.jpeg",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-01-10 20:15:20",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        },
        {
            "id": 1608,
            "product_id": 72,
            "fabric_id": 270,
            "xztfabric": {
                "id": 270,
                "name": "Not Listed",
                "fab_code": "N\/A",
                "fab_specs": "Others",
                "shade_cat": 2,
                "shade_subcat": 8,
                "url": "1643906840.png",
                "show_in_gallery": "Yes",
                "min_width": 48,
                "max_width": 87,
                "created_at": "2022-02-03 16:47:20",
                "updated_at": "2022-09-17 03:21:31",
                "archived": 0
            }
        }
    ],
    "price_cat": {
        "id": 10,
        "parent_id": 2,
        "price_tag": 0,
        "level": 2,
        "name": "ROOM DIMMING",
        "order_level": 0,
        "commision_rate": 0,
        "banner": null,
        "icon": null,
        "featured": 0,
        "top": 0,
        "digital": 0,
        "slug": "room-dimming-collection-dyjfu",
        "meta_title": null,
        "meta_description": null,
        "created_at": "2021-12-16 07:22:47",
        "updated_at": "2021-12-16 02:22:47"
    },
    "price_arr": [
        {
            "width": 24,
            "length": 40,
            "price": 414,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 40,
            "price": 494,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 40,
            "price": 537,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 40,
            "price": 583,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 40,
            "price": 625,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 40,
            "price": 669,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 40,
            "price": 712,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 40,
            "price": 754,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 40,
            "price": 798,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 40,
            "price": 832,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 40,
            "price": 887,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 40,
            "price": 929,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 40,
            "price": 975,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 40,
            "price": 1018,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 40,
            "price": 1143,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 50,
            "price": 462,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 50,
            "price": 507,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 50,
            "price": 552,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 50,
            "price": 600,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 50,
            "price": 647,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 50,
            "price": 692,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 50,
            "price": 738,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 50,
            "price": 783,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 50,
            "price": 829,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 50,
            "price": 865,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 50,
            "price": 923,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 50,
            "price": 968,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 50,
            "price": 1017,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 50,
            "price": 1062,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 50,
            "price": 1192,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 60,
            "price": 473,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 60,
            "price": 520,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 60,
            "price": 569,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 60,
            "price": 619,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 60,
            "price": 668,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 60,
            "price": 717,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 60,
            "price": 765,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 60,
            "price": 813,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 60,
            "price": 862,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 60,
            "price": 900,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 60,
            "price": 960,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 60,
            "price": 1009,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 60,
            "price": 1058,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 60,
            "price": 1108,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 60,
            "price": 1243,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 70,
            "price": 483,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 70,
            "price": 533,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 70,
            "price": 584,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 70,
            "price": 638,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 70,
            "price": 688,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 70,
            "price": 739,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 70,
            "price": 790,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 70,
            "price": 842,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 70,
            "price": 892,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 70,
            "price": 932,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 70,
            "price": 997,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 70,
            "price": 1048,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 70,
            "price": 1102,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 70,
            "price": 1152,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 70,
            "price": 1292,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 80,
            "price": 493,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 80,
            "price": 545,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 80,
            "price": 599,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 80,
            "price": 655,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 80,
            "price": 709,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 80,
            "price": 763,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 80,
            "price": 815,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 80,
            "price": 869,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 80,
            "price": 923,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 80,
            "price": 965,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 80,
            "price": 1033,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 80,
            "price": 1087,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 80,
            "price": 1143,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 80,
            "price": 1195,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 80,
            "price": 1340,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 90,
            "price": 504,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 90,
            "price": 559,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 90,
            "price": 615,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 90,
            "price": 675,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 90,
            "price": 732,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 90,
            "price": 788,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 90,
            "price": 843,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 90,
            "price": 899,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 90,
            "price": 955,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 90,
            "price": 999,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 90,
            "price": 1070,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 90,
            "price": 1125,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 90,
            "price": 1185,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 90,
            "price": 1242,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 90,
            "price": 1392,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 100,
            "price": 514,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 100,
            "price": 573,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 100,
            "price": 635,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 100,
            "price": 693,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 100,
            "price": 752,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 100,
            "price": 785,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 100,
            "price": 868,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 100,
            "price": 928,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 100,
            "price": 987,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 100,
            "price": 1045,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 100,
            "price": 1107,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 100,
            "price": 1153,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 100,
            "price": 1227,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 100,
            "price": 1275,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 100,
            "price": 1425,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 110,
            "price": 535,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 110,
            "price": 582,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 110,
            "price": 648,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 110,
            "price": 712,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 110,
            "price": 773,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 110,
            "price": 834,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 110,
            "price": 899,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 110,
            "price": 957,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 110,
            "price": 1019,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 110,
            "price": 1068,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 110,
            "price": 1144,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 110,
            "price": 1190,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 110,
            "price": 1267,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 110,
            "price": 1305,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 110,
            "price": 1458,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 24,
            "length": 120,
            "price": 548,
            "square_cassette": 75,
            "fabric_wrap": 35,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 30,
            "length": 120,
            "price": 590,
            "square_cassette": 85,
            "fabric_wrap": 40,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 36,
            "length": 120,
            "price": 675,
            "square_cassette": 95,
            "fabric_wrap": 45,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 42,
            "length": 120,
            "price": 755,
            "square_cassette": 105,
            "fabric_wrap": 50,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 48,
            "length": 120,
            "price": 794,
            "square_cassette": 115,
            "fabric_wrap": 55,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 54,
            "length": 120,
            "price": 857,
            "square_cassette": 125,
            "fabric_wrap": 60,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 60,
            "length": 120,
            "price": 922,
            "square_cassette": 135,
            "fabric_wrap": 65,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 66,
            "length": 120,
            "price": 988,
            "square_cassette": 145,
            "fabric_wrap": 70,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 72,
            "length": 120,
            "price": 1049,
            "square_cassette": 155,
            "fabric_wrap": 75,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 78,
            "length": 120,
            "price": 1103,
            "square_cassette": 165,
            "fabric_wrap": 80,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 84,
            "length": 120,
            "price": 1180,
            "square_cassette": 175,
            "fabric_wrap": 85,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 90,
            "length": 120,
            "price": 1225,
            "square_cassette": 185,
            "fabric_wrap": 90,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 96,
            "length": 120,
            "price": 1312,
            "square_cassette": 195,
            "fabric_wrap": 95,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 102,
            "length": 120,
            "price": 1332,
            "square_cassette": 205,
            "fabric_wrap": 100,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        },
        {
            "width": 108,
            "length": 120,
            "price": 1492,
            "square_cassette": 215,
            "fabric_wrap": 105,
            "std_r_cassette": 0,
            "wid_diff": 6,
            "len_diff": 10,
            "round_cassette": 0,
            "motor_array": null
        }
    ],
    "distinct_wid": [
        {
            "width": 24
        },
        {
            "width": 30
        },
        {
            "width": 36
        },
        {
            "width": 42
        },
        {
            "width": 48
        },
        {
            "width": 54
        },
        {
            "width": 60
        },
        {
            "width": 66
        },
        {
            "width": 72
        },
        {
            "width": 78
        },
        {
            "width": 84
        },
        {
            "width": 90
        },
        {
            "width": 96
        },
        {
            "width": 102
        },
        {
            "width": 108
        }
    ],
    "distinct_len": [
        {
            "length": 40
        },
        {
            "length": 50
        },
        {
            "length": 60
        },
        {
            "length": 70
        },
        {
            "length": 80
        },
        {
            "length": 90
        },
        {
            "length": 100
        },
        {
            "length": 110
        },
        {
            "length": 120
        }
    ],
    "fabric_all": [
        {
            "id": 1,
            "products_id": 8,
            "fabric_name": "abcd",
            "fabric_material": "cotton",
            "fabric_img": "abcd-8.jpg"
        },
        {
            "id": 2,
            "products_id": 10,
            "fabric_name": "tuvwx",
            "fabric_material": "silk",
            "fabric_img": "tuvwx-10.jpg"
        }
    ],
    "shade_opt": {
        "id": 1,
        "cat_id": 2,
        "name": "Duo Light filtering",
        "control_type": 1,
        "control_type_arr": 0,
        "mount": 1,
        "fabric_selection": 1,
        "wrap_expose": 1,
        "sq_cassette": 1,
        "round_cassette": 1,
        "std_r_cassette": 0,
        "brackets": 1,
        "bracket_options": 0,
        "smart_options": 1,
        "spring_assist": 0,
        "somfy": 1
    },
    "fab_opt": [],
    "coupon_arr": [],
    "cust_discount": {
        "id": 72,
        "user_id": 100,
        "disc_percent": 65,
        "cs_mark": "CSM-SHA-100",
        "updated_at": "2022-01-03 03:55:39",
        "created_at": "2021-12-29 17:06:56"
    },
    "destinations": [
        {
            "country": "Canada",
            "country_code": 38
        },
        {
            "country": "Mexico",
            "country_code": 142
        },
        {
            "country": "USA",
            "country_code": 231
        }
    ],
    "roomtype": {
        "0": {
            "id": 3507,
            "product_id": 72,
            "roomtype_id": 1,
            "xztroomtype": {
                "id": 1,
                "name": "DINING ROOM",
                "state": "Active",
                "created_at": "2021-10-24 16:06:41",
                "updated_at": "2021-12-16 02:38:53",
                "archived": 0
            }
        },
        "1": {
            "id": 3508,
            "product_id": 72,
            "roomtype_id": 2,
            "xztroomtype": {
                "id": 2,
                "name": "LIVING ROOM",
                "state": "Active",
                "created_at": "2021-10-24 16:07:05",
                "updated_at": "2021-12-16 02:38:27",
                "archived": 0
            }
        },
        "2": {
            "id": 3509,
            "product_id": 72,
            "roomtype_id": 3,
            "xztroomtype": {
                "id": 3,
                "name": "MASTER BEDROOM",
                "state": "Active",
                "created_at": "2021-10-24 16:07:36",
                "updated_at": "2021-12-16 02:38:05",
                "archived": 0
            }
        },
        "3": {
            "id": 3510,
            "product_id": 72,
            "roomtype_id": 4,
            "xztroomtype": {
                "id": 4,
                "name": "KITCHEN",
                "state": "Active",
                "created_at": "2021-10-24 16:08:02",
                "updated_at": "2021-12-16 02:37:35",
                "archived": 0
            }
        },
        "4": {
            "id": 3511,
            "product_id": 72,
            "roomtype_id": 5,
            "xztroomtype": {
                "id": 5,
                "name": "OFFICE",
                "state": "Active",
                "created_at": "2021-10-24 16:08:27",
                "updated_at": "2021-12-16 02:32:15",
                "archived": 0
            }
        },
        "6": {
            "id": 3513,
            "product_id": 72,
            "roomtype_id": 7,
            "xztroomtype": {
                "id": 7,
                "name": "FAMILY ROOM",
                "state": "Active",
                "created_at": "2021-11-11 00:36:21",
                "updated_at": "2021-11-11 00:36:21",
                "archived": 0
            }
        },
        "7": {
            "id": 3514,
            "product_id": 72,
            "roomtype_id": 8,
            "xztroomtype": {
                "id": 8,
                "name": "GAME ROOM",
                "state": "Active",
                "created_at": "2021-11-11 00:37:05",
                "updated_at": "2021-11-11 00:37:05",
                "archived": 0
            }
        },
        "8": {
            "id": 3515,
            "product_id": 72,
            "roomtype_id": 9,
            "xztroomtype": {
                "id": 9,
                "name": "TV ROOM",
                "state": "Active",
                "created_at": "2021-11-11 00:37:54",
                "updated_at": "2021-11-11 00:37:54",
                "archived": 0
            }
        },
        "9": {
            "id": 3516,
            "product_id": 72,
            "roomtype_id": 10,
            "xztroomtype": {
                "id": 10,
                "name": "WASHROOM",
                "state": "Active",
                "created_at": "2021-11-11 00:40:26",
                "updated_at": "2021-11-11 00:40:26",
                "archived": 0
            }
        },
        "10": {
            "id": 3517,
            "product_id": 72,
            "roomtype_id": 11,
            "xztroomtype": {
                "id": 11,
                "name": "FOYER",
                "state": "Active",
                "created_at": "2021-11-11 04:33:23",
                "updated_at": "2021-11-11 04:33:23",
                "archived": 0
            }
        },
        "11": {
            "id": 3518,
            "product_id": 72,
            "roomtype_id": 12,
            "xztroomtype": {
                "id": 12,
                "name": "ENTRANCE",
                "state": "Active",
                "created_at": "2021-11-11 04:33:51",
                "updated_at": "2021-11-11 04:33:51",
                "archived": 0
            }
        },
        "12": {
            "id": 3519,
            "product_id": 72,
            "roomtype_id": 13,
            "xztroomtype": {
                "id": 13,
                "name": "TOYS ROOM",
                "state": "Active",
                "created_at": "2021-11-11 04:34:07",
                "updated_at": "2021-11-11 04:36:30",
                "archived": 0
            }
        },
        "13": {
            "id": 3520,
            "product_id": 72,
            "roomtype_id": 14,
            "xztroomtype": {
                "id": 14,
                "name": "RECEPTION",
                "state": "Active",
                "created_at": "2021-11-11 04:35:41",
                "updated_at": "2021-11-11 04:35:41",
                "archived": 0
            }
        },
        "14": {
            "id": 3521,
            "product_id": 72,
            "roomtype_id": 15,
            "xztroomtype": {
                "id": 15,
                "name": "RESTURANT",
                "state": "Active",
                "created_at": "2021-11-11 04:36:02",
                "updated_at": "2021-11-11 04:36:02",
                "archived": 0
            }
        },
        "15": {
            "id": 3522,
            "product_id": 72,
            "roomtype_id": 16,
            "xztroomtype": {
                "id": 16,
                "name": "PATIO",
                "state": "Active",
                "created_at": "2021-11-11 04:36:58",
                "updated_at": "2021-11-11 04:37:22",
                "archived": 0
            }
        },
        "16": {
            "id": 3523,
            "product_id": 72,
            "roomtype_id": 19,
            "xztroomtype": {
                "id": 19,
                "name": "BOY'S ROOM",
                "state": "Active",
                "created_at": "2022-01-23 18:40:26",
                "updated_at": "2022-01-23 18:41:56",
                "archived": 0
            }
        },
        "17": {
            "id": 3524,
            "product_id": 72,
            "roomtype_id": 20,
            "xztroomtype": {
                "id": 20,
                "name": "GIRl'S ROOM",
                "state": "Active",
                "created_at": "2022-01-23 18:40:44",
                "updated_at": "2022-01-23 18:41:31",
                "archived": 0
            }
        },
        "18": {
            "id": 3525,
            "product_id": 72,
            "roomtype_id": 21,
            "xztroomtype": {
                "id": 21,
                "name": "ENSUITE",
                "state": "Active",
                "created_at": "2022-01-23 18:41:01",
                "updated_at": "2022-01-23 18:41:01",
                "archived": 0
            }
        },
        "19": {
            "id": 3526,
            "product_id": 72,
            "roomtype_id": 22,
            "xztroomtype": {
                "id": 22,
                "name": "BEDROOM 1",
                "state": "Active",
                "created_at": "2022-01-23 18:42:14",
                "updated_at": "2022-01-23 18:42:14",
                "archived": 0
            }
        },
        "20": {
            "id": 3527,
            "product_id": 72,
            "roomtype_id": 23,
            "xztroomtype": {
                "id": 23,
                "name": "BEDROOM 2",
                "state": "Active",
                "created_at": "2022-01-23 18:42:36",
                "updated_at": "2022-01-23 18:42:36",
                "archived": 0
            }
        },
        "21": {
            "id": 3528,
            "product_id": 72,
            "roomtype_id": 24,
            "xztroomtype": {
                "id": 24,
                "name": "BEDROOM 3",
                "state": "Active",
                "created_at": "2022-01-23 18:42:50",
                "updated_at": "2022-01-23 18:42:50",
                "archived": 0
            }
        },
        "22": {
            "id": 3529,
            "product_id": 72,
            "roomtype_id": 25,
            "xztroomtype": {
                "id": 25,
                "name": "BEDROOM 4",
                "state": "Active",
                "created_at": "2022-01-23 18:43:07",
                "updated_at": "2022-01-23 18:43:07",
                "archived": 0
            }
        },
        "23": {
            "id": 3530,
            "product_id": 72,
            "roomtype_id": 26,
            "xztroomtype": {
                "id": 26,
                "name": "GUEST ROOM",
                "state": "Active",
                "created_at": "2022-01-23 18:43:24",
                "updated_at": "2022-01-23 18:43:24",
                "archived": 0
            }
        },
        "24": {
            "id": 3531,
            "product_id": 72,
            "roomtype_id": 27,
            "xztroomtype": {
                "id": 27,
                "name": "GAME ROOM",
                "state": "Active",
                "created_at": "2022-01-23 18:45:38",
                "updated_at": "2022-01-23 18:45:38",
                "archived": 0
            }
        },
        "25": {
            "id": 3532,
            "product_id": 72,
            "roomtype_id": 28,
            "xztroomtype": {
                "id": 28,
                "name": "HALLWAY",
                "state": "Active",
                "created_at": "2022-01-23 18:45:53",
                "updated_at": "2022-01-23 18:45:53",
                "archived": 0
            }
        },
        "26": {
            "id": 3533,
            "product_id": 72,
            "roomtype_id": 29,
            "xztroomtype": {
                "id": 29,
                "name": "LOFT",
                "state": "Active",
                "created_at": "2022-01-23 18:46:06",
                "updated_at": "2022-01-23 18:46:06",
                "archived": 0
            }
        },
        "27": {
            "id": 3534,
            "product_id": 72,
            "roomtype_id": 30,
            "xztroomtype": {
                "id": 30,
                "name": "DEN",
                "state": "Active",
                "created_at": "2022-01-23 18:47:14",
                "updated_at": "2022-01-23 18:47:14",
                "archived": 0
            }
        },
        "28": {
            "id": 3535,
            "product_id": 72,
            "roomtype_id": 31,
            "xztroomtype": {
                "id": 31,
                "name": "CLOSET",
                "state": "Active",
                "created_at": "2022-01-23 18:47:32",
                "updated_at": "2022-01-23 18:47:32",
                "archived": 0
            }
        },
        "29": {
            "id": 3536,
            "product_id": 72,
            "roomtype_id": 32,
            "xztroomtype": {
                "id": 32,
                "name": "NURSERY",
                "state": "Active",
                "created_at": "2022-01-23 18:48:55",
                "updated_at": "2022-01-23 18:48:55",
                "archived": 0
            }
        },
        "30": {
            "id": 3537,
            "product_id": 72,
            "roomtype_id": 33,
            "xztroomtype": {
                "id": 33,
                "name": "LAUNDRY",
                "state": "Active",
                "created_at": "2022-01-23 18:49:13",
                "updated_at": "2022-01-23 18:49:13",
                "archived": 0
            }
        },
        "31": {
            "id": 3538,
            "product_id": 72,
            "roomtype_id": 34,
            "xztroomtype": {
                "id": 34,
                "name": "LIBRARY",
                "state": "Active",
                "created_at": "2022-01-23 18:49:33",
                "updated_at": "2022-01-23 18:49:33",
                "archived": 0
            }
        },
        "32": {
            "id": 3539,
            "product_id": 72,
            "roomtype_id": 36,
            "xztroomtype": {
                "id": 36,
                "name": "MASTER BATHROOM",
                "state": "Active",
                "created_at": "2022-03-27 22:30:47",
                "updated_at": "2022-03-27 22:31:12",
                "archived": 0
            }
        },
        "33": {
            "id": 3540,
            "product_id": 72,
            "roomtype_id": 37,
            "xztroomtype": {
                "id": 37,
                "name": "HALL",
                "state": "Active",
                "created_at": "2022-03-27 22:31:29",
                "updated_at": "2022-03-27 22:31:29",
                "archived": 0
            }
        },
        "34": {
            "id": 3541,
            "product_id": 72,
            "roomtype_id": 38,
            "xztroomtype": {
                "id": 38,
                "name": "DOOR",
                "state": "Active",
                "created_at": "2022-08-04 21:49:53",
                "updated_at": "2022-08-21 21:55:29",
                "archived": 0
            }
        },
        "35": {
            "id": 3542,
            "product_id": 72,
            "roomtype_id": 39,
            "xztroomtype": {
                "id": 39,
                "name": "GYM",
                "state": "Active",
                "created_at": "2022-08-21 21:45:42",
                "updated_at": "2022-08-21 21:45:42",
                "archived": 0
            }
        },
        "36": {
            "id": 3543,
            "product_id": 72,
            "roomtype_id": 40,
            "xztroomtype": {
                "id": 40,
                "name": "MEDIA ROOM",
                "state": "Active",
                "created_at": "2022-08-21 21:46:02",
                "updated_at": "2022-08-21 21:46:02",
                "archived": 0
            }
        },
        "38": {
            "id": 3545,
            "product_id": 72,
            "roomtype_id": 42,
            "xztroomtype": {
                "id": 42,
                "name": "STAIR CASE",
                "state": "Active",
                "created_at": "2022-08-24 21:36:01",
                "updated_at": "2022-08-24 21:36:01",
                "archived": 0
            }
        },
        "39": {
            "id": 3546,
            "product_id": 72,
            "roomtype_id": 43,
            "xztroomtype": {
                "id": 43,
                "name": "BATHROOM",
                "state": "Active",
                "created_at": "2022-08-24 21:37:48",
                "updated_at": "2022-08-24 21:37:48",
                "archived": 0
            }
        },
        "40": {
            "id": 3512,
            "product_id": 72,
            "roomtype_id": 6,
            "xztroomtype": {
                "id": 6,
                "name": "OTHER",
                "state": "Active",
                "created_at": "2021-10-24 16:08:49",
                "updated_at": "2021-12-16 02:32:33",
                "archived": 0
            }
        }
    },
    "mount": [
        {
            "id": 611,
            "product_id": 72,
            "mount_id": 1,
            "xztmount": {
                "id": 1,
                "name": "Inside",
                "price": 0,
                "position": "Right",
                "image": "1635969983-inside.jpeg",
                "created_at": "2021-10-24 12:32:25",
                "updated_at": "2021-11-03 20:06:23",
                "state": "Active",
                "archived": 0
            }
        },
        {
            "id": 612,
            "product_id": 72,
            "mount_id": 2,
            "xztmount": {
                "id": 2,
                "name": "Outside",
                "price": 0,
                "position": "Right",
                "image": "1635970024-outside.jpeg",
                "created_at": "2021-10-24 12:33:00",
                "updated_at": "2022-02-07 12:49:35",
                "state": "Active",
                "archived": 0
            }
        }
    ],
    "cassette": [
        {
            "id": 645,
            "product_id": 72,
            "cassette_code": "duo_sqcass_01",
            "xztcassette": {
                "id": 15,
                "cassette_code": "duo_sqcass_01",
                "name": "Square Cassette (Duo)",
                "category_id": 2,
                "min_wid": 103,
                "max_wid": 108,
                "price": 215,
                "created_at": "2021-11-05 00:26:13",
                "updated_at": "2021-11-05 00:26:13",
                "state": "Active",
                "archived": 0,
                "casscolor": [
                    {
                        "id": 518,
                        "cassette_id": 15,
                        "color": "default"
                    },
                    {
                        "id": 519,
                        "cassette_id": 15,
                        "color": "white"
                    },
                    {
                        "id": 520,
                        "cassette_id": 15,
                        "color": "ivory"
                    },
                    {
                        "id": 521,
                        "cassette_id": 15,
                        "color": "grey"
                    },
                    {
                        "id": 522,
                        "cassette_id": 15,
                        "color": "black"
                    }
                ]
            }
        },
        {
            "id": 646,
            "product_id": 72,
            "cassette_code": "common_round01",
            "xztcassette": {
                "id": 90,
                "cassette_code": "common_round01",
                "name": "Round Cassette",
                "category_id": 0,
                "min_wid": 12,
                "max_wid": 300,
                "price": 0,
                "created_at": "2021-11-04 19:55:47",
                "updated_at": "2021-11-04 19:55:47",
                "state": "Active",
                "archived": 0,
                "casscolor": [
                    {
                        "id": 885,
                        "cassette_id": 90,
                        "color": "default"
                    },
                    {
                        "id": 886,
                        "cassette_id": 90,
                        "color": "white"
                    },
                    {
                        "id": 887,
                        "cassette_id": 90,
                        "color": "ivory"
                    },
                    {
                        "id": 888,
                        "cassette_id": 90,
                        "color": "grey"
                    },
                    {
                        "id": 889,
                        "cassette_id": 90,
                        "color": "black"
                    }
                ]
            }
        }
    ],
    "bracket": [
        {
            "id": 601,
            "product_id": 72,
            "bracket_id": 1,
            "xztbracket": {
                "id": 1,
                "name": "Wall",
                "price": 0,
                "image": "1637158364-wall-bracket.jpg",
                "state": "Active",
                "created_at": "2021-10-24 12:48:24",
                "updated_at": "2021-11-17 14:12:44",
                "archived": 0
            }
        },
        {
            "id": 602,
            "product_id": 72,
            "bracket_id": 2,
            "xztbracket": {
                "id": 2,
                "name": "Ceiling",
                "price": 0,
                "image": "1637158336-ceiling-bracket.jpg",
                "state": "Active",
                "created_at": "2021-10-24 12:48:55",
                "updated_at": "2021-11-17 14:12:16",
                "archived": 0
            }
        }
    ],
    "springassist": [],
    "wrap": {
        "id": 191,
        "product_id": 72,
        "wrap_code": "duo_fabwrap_01",
        "xztwrap": {
            "id": 15,
            "wrap_code": "duo_fabwrap_01",
            "name": "Duo Wrapped",
            "min_wid": 103,
            "max_wid": 108,
            "price": 105,
            "created_at": "2021-10-25 10:59:42",
            "updated_at": "2021-10-25 10:59:42",
            "state": "Active",
            "archived": 0
        }
    },
    "stack": [],
    "mountpos": [
        {
            "id": 1,
            "position": "Right",
            "image": "1636007889-right.jpeg",
            "created_at": "2021-11-04 06:31:35",
            "updated_at": "2021-11-04 06:38:09",
            "state": "Active",
            "archived": 0
        },
        {
            "id": 2,
            "position": "Left",
            "image": "1636008056-left.jpeg",
            "created_at": "2021-11-04 06:40:56",
            "updated_at": "2021-12-16 13:44:59",
            "state": "Active",
            "archived": 0
        },
        {
            "id": 3,
            "position": "standard",
            "image": "1639567150-Testfabric1.jfif",
            "created_at": "2021-12-15 11:19:10",
            "updated_at": "2021-12-15 11:19:23",
            "state": "Inactive",
            "archived": 1
        },
        {
            "id": 4,
            "position": "standard",
            "image": "1639662917-willow-bracket.jpg",
            "created_at": "2021-12-16 13:55:17",
            "updated_at": "2021-12-16 13:55:25",
            "state": "Inactive",
            "archived": 1
        },
        {
            "id": 5,
            "position": "Left \/ Right",
            "image": "1643475178-28902CCC-3D9E-48A1-BA78-7CC451E25CEB.jp",
            "created_at": "2022-01-03 04:09:16",
            "updated_at": "2022-01-29 16:52:58",
            "state": "Active",
            "archived": 0
        },
        {
            "id": 6,
            "position": "center",
            "image": "1644238246-Random roller collection.webp",
            "created_at": "2022-02-07 12:50:46",
            "updated_at": "2022-02-07 12:51:23",
            "state": "Inactive",
            "archived": 1
        }
    ],
    "controltype": [
        {
            "id": 1457,
            "product_id": 72,
            "ct_manual_id": 1,
            "ct_motor_id": null,
            "ct_widmotor_code": null
        },
        {
            "id": 1458,
            "product_id": 72,
            "ct_manual_id": 2,
            "ct_motor_id": null,
            "ct_widmotor_code": null
        },
        {
            "id": 1459,
            "product_id": 72,
            "ct_manual_id": 3,
            "ct_motor_id": null,
            "ct_widmotor_code": null
        },
        {
            "id": 1460,
            "product_id": 72,
            "ct_manual_id": 4,
            "ct_motor_id": null,
            "ct_widmotor_code": null
        },
        {
            "id": 1461,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 1,
            "ct_widmotor_code": null
        },
        {
            "id": 1462,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 2,
            "ct_widmotor_code": null
        },
        {
            "id": 1463,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 3,
            "ct_widmotor_code": null
        },
        {
            "id": 1464,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 4,
            "ct_widmotor_code": null
        },
        {
            "id": 1465,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 5,
            "ct_widmotor_code": null
        }
    ],
    "ct_manuals": [
        {
            "id": 1457,
            "product_id": 72,
            "ct_manual_id": 1,
            "ct_motor_id": null,
            "ct_widmotor_code": null,
            "manual": {
                "id": 1,
                "ct_code": "chain_man01",
                "name": "Chain Right",
                "position": "Right",
                "image": "1637157769-right.jpeg",
                "state": "Active",
                "created_at": "2021-10-24 12:19:22",
                "updated_at": "2021-11-17 14:02:49",
                "archived": 0
            }
        },
        {
            "id": 1458,
            "product_id": 72,
            "ct_manual_id": 2,
            "ct_motor_id": null,
            "ct_widmotor_code": null,
            "manual": {
                "id": 2,
                "ct_code": "chain_man02",
                "name": "Chain Left",
                "position": "Left",
                "image": "1637157788-left.jpeg",
                "state": "Active",
                "created_at": "2021-10-24 12:20:16",
                "updated_at": "2021-11-17 14:03:08",
                "archived": 0
            }
        },
        {
            "id": 1459,
            "product_id": 72,
            "ct_manual_id": 3,
            "ct_motor_id": null,
            "ct_widmotor_code": null,
            "manual": {
                "id": 3,
                "ct_code": "cord_man01",
                "name": "Cord Right",
                "position": "Right",
                "image": "1637157809-right.jpeg",
                "state": "Active",
                "created_at": "2021-10-24 12:24:19",
                "updated_at": "2021-11-17 14:03:29",
                "archived": 0
            }
        },
        {
            "id": 1460,
            "product_id": 72,
            "ct_manual_id": 4,
            "ct_motor_id": null,
            "ct_widmotor_code": null,
            "manual": {
                "id": 4,
                "ct_code": "cord_man02",
                "name": "Cord Left",
                "position": "Left",
                "image": "1637157831-left.jpeg",
                "state": "Active",
                "created_at": "2021-10-24 12:25:10",
                "updated_at": "2021-11-17 14:03:51",
                "archived": 0
            }
        }
    ],
    "ct_motors": [
        {
            "id": 1461,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 1,
            "ct_widmotor_code": null,
            "motor": {
                "id": 1,
                "ct_code": "rmb01",
                "name": "Rechargeable Battery Motor",
                "price": 125,
                "length": "0 ft.",
                "state": "Active",
                "created_at": "2021-10-24 11:10:22",
                "updated_at": "2021-10-24 11:10:22",
                "archived": 0
            }
        },
        {
            "id": 1462,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 2,
            "ct_widmotor_code": null,
            "motor": {
                "id": 2,
                "ct_code": "12vm01",
                "name": "12 Volt Motor",
                "price": 155,
                "length": "0 ft.",
                "state": "Active",
                "created_at": "2021-10-24 11:11:01",
                "updated_at": "2021-10-24 11:11:01",
                "archived": 0
            }
        },
        {
            "id": 1463,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 3,
            "ct_widmotor_code": null,
            "motor": {
                "id": 3,
                "ct_code": "24vm01",
                "name": "24 Volt Motor",
                "price": 155,
                "length": "0 ft.",
                "state": "Active",
                "created_at": "2021-10-24 11:11:50",
                "updated_at": "2021-10-24 11:11:50",
                "archived": 0
            }
        },
        {
            "id": 1464,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 4,
            "ct_widmotor_code": null,
            "motor": {
                "id": 4,
                "ct_code": "110vm01",
                "name": "110 Volt Motor",
                "price": 155,
                "length": "0 ft.",
                "state": "Active",
                "created_at": "2021-10-24 11:12:24",
                "updated_at": "2021-10-24 11:12:24",
                "archived": 0
            }
        },
        {
            "id": 1465,
            "product_id": 72,
            "ct_manual_id": null,
            "ct_motor_id": 5,
            "ct_widmotor_code": null,
            "motor": {
                "id": 5,
                "ct_code": "swm01",
                "name": "Shadeowand",
                "price": 155,
                "length": "0 ft.",
                "state": "Active",
                "created_at": "2021-10-24 11:12:59",
                "updated_at": "2021-10-24 11:21:07",
                "archived": 0
            }
        }
    ],
    "ct_wid_motors": null,
    "wid_motor_max": "",
    "invoice": {
        "id": 1,
        "keys": "ORDER_NO",
        "values": 2079
    }
}
```

### HTTP Request
`GET api/v3/cart/{id}/{seller_id}`


<!-- END_3fefa1d25e01b547a27fae8b7abb5feb -->

<!-- START_b6e172ae5b3a3f0d0dffa7ce27490064 -->
## Create a new order. This api route will create a new order for seller [seller_id] with all products data passed with request.

> Example request:

```bash
curl -X POST "/api/v3/create-order" \
    -H "Content-Type: application/json" \
    -d '{"seller_id":100,"products":[{"prod_id":60,"dealer_name":"John Deo","order_number":"100-54646356-60","due_date":"20-02-2023","disc_percent":65,"shade_price":2797.228978,"mount_price":40,"mount_type":"explicabo","mount_pos":"deleniti","wrap_expose":"eum","wrap_price":63634,"cassette_price":6742.435,"cassette_type":"nobis","cassette_color":"est","bottom_rail_price":52149504.6325,"bottom_rail":"accusantium","bottom_rail_color":"quo","brackets_opt":"architecto","brackets_opt_price":50.879415537,"spring_assist_price":216457383.06926,"cust_side_mark":"quisquam","project_tag":"odit","room_type":"expedita","window_desc":"quia","quantity":1,"width":20,"wid_decimal":3.4,"length":2,"len_decimal":311.134105,"fabric":"odit","stack":"aut","control_type":"quaerat","motor_name":"omnis","motor_pos":"aut","motor_price":1586.2,"motor_arr_price":5464.9,"channel_name":"sed","channel_price":19354.52,"plugin_price":632.6,"solar_price":578277.81344,"hub_price":1094629.7598227,"transformer_price":1787417.43,"chain_cord":"debitis","chain_ctrl":"architecto","chain_color":"tenetur","cord_ctrl":"aspernatur","cord_color":"velit","brackets":"voluptas","sp_instructions":"reprehenderit","parts":7,"price":193147.6133,"suggested_price":209641.89,"total":0}],"ship":{"ship_name":"omnis","ship_email":"rerum","ship_addr":"sapiente","ship_addr2":"magni","ship_country":"vel","ship_city":"corporis","ship_zip":"reiciendis"},"ord_grandtotal":4500,"coupon_val":0}'

```

```javascript
const url = new URL("/api/v3/create-order");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "seller_id": 100,
    "products": [
        {
            "prod_id": 60,
            "dealer_name": "John Deo",
            "order_number": "100-54646356-60",
            "due_date": "20-02-2023",
            "disc_percent": 65,
            "shade_price": 2797.228978,
            "mount_price": 40,
            "mount_type": "explicabo",
            "mount_pos": "deleniti",
            "wrap_expose": "eum",
            "wrap_price": 63634,
            "cassette_price": 6742.435,
            "cassette_type": "nobis",
            "cassette_color": "est",
            "bottom_rail_price": 52149504.6325,
            "bottom_rail": "accusantium",
            "bottom_rail_color": "quo",
            "brackets_opt": "architecto",
            "brackets_opt_price": 50.879415537,
            "spring_assist_price": 216457383.06926,
            "cust_side_mark": "quisquam",
            "project_tag": "odit",
            "room_type": "expedita",
            "window_desc": "quia",
            "quantity": 1,
            "width": 20,
            "wid_decimal": 3.4,
            "length": 2,
            "len_decimal": 311.134105,
            "fabric": "odit",
            "stack": "aut",
            "control_type": "quaerat",
            "motor_name": "omnis",
            "motor_pos": "aut",
            "motor_price": 1586.2,
            "motor_arr_price": 5464.9,
            "channel_name": "sed",
            "channel_price": 19354.52,
            "plugin_price": 632.6,
            "solar_price": 578277.81344,
            "hub_price": 1094629.7598227,
            "transformer_price": 1787417.43,
            "chain_cord": "debitis",
            "chain_ctrl": "architecto",
            "chain_color": "tenetur",
            "cord_ctrl": "aspernatur",
            "cord_color": "velit",
            "brackets": "voluptas",
            "sp_instructions": "reprehenderit",
            "parts": 7,
            "price": 193147.6133,
            "suggested_price": 209641.89,
            "total": 0
        }
    ],
    "ship": {
        "ship_name": "omnis",
        "ship_email": "rerum",
        "ship_addr": "sapiente",
        "ship_addr2": "magni",
        "ship_country": "vel",
        "ship_city": "corporis",
        "ship_zip": "reiciendis"
    },
    "ord_grandtotal": 4500,
    "coupon_val": 0
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "success": true,
    "message": "Order created successfully"
}
```

### HTTP Request
`POST api/v3/create-order`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    seller_id | integer |  required  | The id of the seller.
    products.*.prod_id | integer |  required  | The prod_id field.
    products.*.dealer_name | string |  optional  | The dealer_name field.
    products.*.order_number | string |  optional  | The order_number field.
    products.*.due_date | string |  optional  | The due_date field.
    products.*.disc_percent | float |  optional  | The disc_percent field.
    products.*.shade_price | float |  optional  | The shade_price field. Example 465
    products.*.mount_price | float |  optional  | The mount_price field.
    products.*.mount_type | string |  optional  | The mount_type field
    products.*.mount_pos | string |  optional  | The mount_pos field
    products.*.wrap_expose | string |  optional  | The wrap_expose field
    products.*.wrap_price | float |  optional  | The wrap_price field
    products.*.cassette_price | float |  optional  | The cassette_price field
    products.*.cassette_type | string |  optional  | The cassette_type field
    products.*.cassette_color | string |  optional  | The cassette_color field
    products.*.bottom_rail_price | float |  optional  | The bottom_rail_price field
    products.*.bottom_rail | string |  optional  | The bottom_rail field
    products.*.bottom_rail_color | string |  optional  | The bottom_rail_color field
    products.*.brackets_opt | string |  optional  | The brackets_opt field
    products.*.brackets_opt_price | float |  optional  | The brackets_opt_price field
    products.*.spring_assist_price | float |  optional  | The spring_assist_price field
    products.*.cust_side_mark | string |  optional  | The cust_side_mark field
    products.*.project_tag | string |  optional  | The project_tag field
    products.*.room_type | string |  optional  | The room_type field
    products.*.window_desc | string |  optional  | The window_desc field
    products.*.quantity | integer |  optional  | The quantity field
    products.*.width | integer |  optional  | The width field
    products.*.wid_decimal | float |  optional  | The wid_decimal field
    products.*.length | integer |  optional  | The length field
    products.*.len_decimal | float |  optional  | The len_decimal field
    products.*.fabric | string |  optional  | The fabric field
    products.*.stack | string |  optional  | The stack field
    products.*.control_type | string |  optional  | The control_type field
    products.*.motor_name | string |  optional  | The motor_name field
    products.*.motor_pos | string |  optional  | The motor_pos field
    products.*.motor_price | float |  optional  | The motor_price field
    products.*.motor_arr_price | float |  optional  | The motor_arr_price field
    products.*.channel_name | string |  optional  | The channel_name field
    products.*.channel_price | float |  optional  | The channel_price field
    products.*.plugin_price | float |  optional  | The plugin_price field
    products.*.solar_price | float |  optional  | The solar_price field
    products.*.hub_price | float |  optional  | The hub_price field
    products.*.transformer_price | float |  optional  | The transformer_price field
    products.*.chain_cord | string |  optional  | The chain_cord field
    products.*.chain_ctrl | string |  optional  | The chain_ctrl field
    products.*.chain_color | string |  optional  | The chain_color field
    products.*.cord_ctrl | string |  optional  | The cord_ctrl field
    products.*.cord_color | string |  optional  | The cord_color field
    products.*.brackets | string |  optional  | The brackets field
    products.*.sp_instructions | string |  optional  | The sp_instructions field
    products.*.parts | integer |  optional  | The parts field . Example 0 | 1
    products.*.price | float |  optional  | The price field
    products.*.suggested_price | float |  optional  | The suggested_price field
    products.*.total | float |  optional  | The total field
    ship.ship_name | string |  required  | The ship_name of order.
    ship.ship_email | string |  required  | The ship_email of order.
    ship.ship_addr | string |  required  | The ship_addr of order.
    ship.ship_addr2 | string |  required  | The ship_addr2 of order.
    ship.ship_country | string |  required  | The ship_country of order.
    ship.ship_city | string |  required  | The ship_city of order.
    ship.ship_zip | string |  required  | The ship_zip of order.
    ord_grandtotal | float |  required  | The grand total amount of order after coupon and discount.
    coupon_val | float |  required  | The coupon amount of order if any else pass 0.

<!-- END_b6e172ae5b3a3f0d0dffa7ce27490064 -->


