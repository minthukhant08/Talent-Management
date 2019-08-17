# Course Feature
The endpoint controls Courses.-


# Retrieve the list of courses [/v1/courses]

### GET

+ Parameters
    + limit : `30` (optional, integer)
    + offset : `0` (optional, integer)


Retrieve the list of courses.

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/courses",
                    "limit": 2,
                    "offset": 0,
                    "total": 10
                },
                "data": [
                {
                      "id": 15,
                      "name": "Jamal Turner",
                      "descriptions": "Voluptatum quaerat accusantium nobis quo optio. Nobis voluptatem exercitationem placeat. Eligendi laudantium excepturi amet nesciunt explicabo.",
                      "start_date": "2013-05-13",
                      "end_date": "1988-05-24",
                      "image": "http://localhost:8000/api/v1/courses/image/15",
                      "topic": [
                            {
                                "id": 12,
                                "name": null,
                                "descriptions": "Numquam mollitia voluptatum est rerum est occaecati. Et dolorem beatae nisi dicta tenetur quibusdam iure. Sint aut ipsa ipsa quisquam dicta dolores.",
                                "start_date": "2014-08-21",
                                "end_date": "2014-12-23"
                            },
                            {
                                "id": 14,
                                "name": null,
                                "descriptions": "Qui et aut sint officiis qui quo architecto. Totam dolore voluptates sequi ea quo molestias. Excepturi eligendi porro tempora est. Quia unde dolor in in. Molestias aut nisi expedita aliquam quam.",
                                "start_date": "2009-03-14",
                                "end_date": "2014-07-29"
                            }
                        ]
                    },
                    {
                        "id": 17,
                        "name": "Donna Goldner",
                        "descriptions": "Et illo aperiam quia eos. Dolor et eos ratione dolores impedit architecto. Est ratione aut ad architecto aut rem. Aut vel architecto recusandae reprehenderit ut modi harum qui.",
                        "start_date": "2018-08-16",
                        "end_date": "2017-07-31",
                        "image": "http://localhost:8000/api/v1/courses/image/17",
                        "topic": [
                            {
                                "id": 2,
                                "name": null,
                                "descriptions": "Molestias accusamus laudantium est officiis blanditiis eum saepe. Neque voluptas voluptates sequi facilis. Repellat praesentium iusto unde quisquam possimus. Consectetur officiis sed voluptas aut ducimus aliquid atque temporibus.",
                                "start_date": "2003-02-17",
                                "end_date": "1970-03-18"
                            }
                        ]
                    }
                ],
                "errors": {},
                "duration": 0.061
            }


### GET

## Retrieve a specific Course [/v1/courses/:id]

 Retrieve a specific course.

### GET

+ Parameter
    + id: `1` (required, integer) - To filter by specific course id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/courses/17",
                    "limit": 30,
                    "offset": 0
                },
                "data": [
                    {
                        "id": 17,
                        "name": "Donna Goldner",
                        "descriptions": "Et illo aperiam quia eos. Dolor et eos ratione dolores impedit architecto. Est ratione aut ad architecto aut rem. Aut vel architecto recusandae reprehenderit ut modi harum qui.",
                        "start_date": "2018-08-16",
                        "end_date": "2017-07-31",
                        "image": "http://localhost:8000/api/v1/courses/image/17",
                        "topic": [
                            {
                                "id": 2,
                                "name": null,
                                "descriptions": "Molestias accusamus laudantium est officiis blanditiis eum saepe. Neque voluptas voluptates sequi facilis. Repellat praesentium iusto unde quisquam possimus. Consectetur officiis sed voluptas aut ducimus aliquid atque temporibus.",
                                "start_date": "2003-02-17",
                                "end_date": "1970-03-18"
                            }
                        ]
                    }
                ],
                "errors": {},
                "duration": 0.072
            }

+ Response 404 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 404,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/courses/155",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                  "message": "The resource that match ID: ( 155 ) does not found.",
                  "code": 400001
                },
                "duration": 0.079
            }

## Get an Course Image [/v1/courses/image/:id]

   Retrieve the profile image of a course that correspond to the ID as the last segment of the URL.

   + Parameter
       + id: `7` (required, integer) - A primary key of courses id.


   + Response 200 (image/png)


![course_image](images/2019/08/40845910.png)

## Creates a Course [/v1/courses]

  Creates a course.

### POST
+ Parameters
    + name: `Java Offshore` (required, string).
    + image: `image.png` (required, image).
    + descriptions: `something` (required, string).
    + start_date: `1971-11-15` (required, date).
    + end_date: `1971-11-15` (required, date).


+ Response 201 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/courses",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                    "id": 16
                },
                "errors": {},
                "duration": 0.237
            }


+ Response 400 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 400,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/courses",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                    "code": 400002,
                    "validation": [
                        {
                            "attribue": "name",
                            "message": "The name field is required."
                        },
                        {
                            "attribue": "image",
                            "message": "The image field is required."
                        },
                        {
                            "attribue": "image",
                            "message": "The image must be an image."
                        }
                    ]
                },
                "duration": 0.005
            }

## Updates a Course [/v1/courses/:id]

  Updates a course that correspond to the ID as the last segment of the URL.

  ### PUT

  + Parameter
    + id:`1` (required, string). - To filter by specific course id.
    + name: `Java Offshore` (optional, string).
    + image: `image.png` (optional, image).
    + descriptions: `something` (optional, string).
    + start_date: `1971-11-15` (optional, date).
    + end_date: `1971-11-15` (optional, date).


  + Response 201 (application/json; charset=utf-8)

      + Body

              {
                  "success": 1,
                  "code": 200,
                  "meta": {
                      "method": "PUT",
                      "endpoint": "api/v1/users/11",
                      "limit": 30,
                      "offset": 0
                  },
                  "data": {
                      "updated": 1
                  },
                  "errors": {},
                  "duration": 0.056
              }


+ Response 400 (application/json; charset=utf-8)

    + Body

                {
                    "success": 0,
                    "code": 400,
                    "meta": {
                        "method": "PUT",
                        "endpoint": "api/v1/courses/1",
                        "limit": 30,
                        "offset": 0
                    },
                    "data": [],
                    "errors": {
                        "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                        "code": 400002,
                        "validation": [
                            {
                                "attribue": "image",
                                "message": "The image must be an image."
                            }
                        ]
                    },
                    "duration": 0.005
                }


## Deletes a Course [/v1/courses/:id]

  Deletes a course that correspond to the ID as the last segment of the URL.

### DELETE

+ Parameter
    + id: `7` (required, integer) - A primary key of course id.


+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "DELETE",
                    "endpoint": "api/v1/courses/1",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                    "deleted": 1
                },
                "errors": {},
                "duration": 0.121
            }

+ Response 404 (application/json; charset=utf-8)

    + Body

            {
                "success": 0,
                "code": 404,
                "meta": {
                    "method": "DELETE",
                    "endpoint": "api/v1/courses/1333",
                    "limit": 30,
                    "offset": 0
                },
                "data": [],
                "errors": {
                    "message": "The resource that match ID: ( 1333 ) does not found.",
                    "code": 400001
                },
                "duration": 0.019
            }
