# ekasir

```
+-----------+------------------------------------+------------------------------------------------------------+
| Method    | URI                                | Action                                                     |
+-----------+------------------------------------+------------------------------------------------------------+
| GET|HEAD  | /                                  | Closure                                                    |
| POST      | api/v1/auth/login                  | App\Http\Controllers\Api\V1\AuthController@login           |
| POST      | api/v1/auth/logout                 | App\Http\Controllers\Api\V1\AuthController@logout          |
| POST      | api/v1/auth/me                     | App\Http\Controllers\Api\V1\AuthController@me              |
| POST      | api/v1/auth/refresh                | App\Http\Controllers\Api\V1\AuthController@refresh         |
| GET|HEAD  | api/v1/barang                      | App\Http\Controllers\Api\V1\BarangController@index         |
| POST      | api/v1/barang                      | App\Http\Controllers\Api\V1\BarangController@store         |
| POST      | api/v1/barang-rusak                | App\Http\Controllers\Api\V1\BarangRusakController@store    |
| GET|HEAD  | api/v1/barang-rusak                | App\Http\Controllers\Api\V1\BarangRusakController@index    |
| DELETE    | api/v1/barang-rusak/{barang_rusak} | App\Http\Controllers\Api\V1\BarangRusakController@destroy  |
| PUT|PATCH | api/v1/barang-rusak/{barang_rusak} | App\Http\Controllers\Api\V1\BarangRusakController@update   |
| GET|HEAD  | api/v1/barang-rusak/{barang_rusak} | App\Http\Controllers\Api\V1\BarangRusakController@show     |
| DELETE    | api/v1/barang/{barang}             | App\Http\Controllers\Api\V1\BarangController@destroy       |
| PUT|PATCH | api/v1/barang/{barang}             | App\Http\Controllers\Api\V1\BarangController@update        |
| GET|HEAD  | api/v1/barang/{barang}             | App\Http\Controllers\Api\V1\BarangController@show          |
| GET|HEAD  | api/v1/permission                  | App\Http\Controllers\Api\V1\PermissionController@index     |
| POST      | api/v1/permission                  | App\Http\Controllers\Api\V1\PermissionController@store     |
| GET|HEAD  | api/v1/permission/{permission}     | App\Http\Controllers\Api\V1\PermissionController@show      |
| PUT|PATCH | api/v1/permission/{permission}     | App\Http\Controllers\Api\V1\PermissionController@update    |
| DELETE    | api/v1/permission/{permission}     | App\Http\Controllers\Api\V1\PermissionController@destroy   |
| GET|HEAD  | api/v1/role                        | App\Http\Controllers\Api\V1\RoleController@index           |
| POST      | api/v1/role                        | App\Http\Controllers\Api\V1\RoleController@store           |
| PUT       | api/v1/role/{id}/sync              | App\Http\Controllers\Api\V1\RoleController@sync_permission |
| GET|HEAD  | api/v1/role/{name}                 | App\Http\Controllers\Api\V1\RoleController@show_byname     |
| GET|HEAD  | api/v1/role/{role}                 | App\Http\Controllers\Api\V1\RoleController@show            |
| PUT|PATCH | api/v1/role/{role}                 | App\Http\Controllers\Api\V1\RoleController@update          |
| DELETE    | api/v1/role/{role}                 | App\Http\Controllers\Api\V1\RoleController@destroy         |
+-----------+------------------------------------+------------------------------------------------------------+
```