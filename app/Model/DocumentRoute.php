<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/13/2017
 * Time: 11:32 AM
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Responses\ResponseBuilder;

require_once __DIR__.'/../Responses/_loader.php';

class DocumentRoute
{
     static $route = [] ;

    static function route($name, $uri, $method, $params = [], $desc = '', $successResponse, $failResponse)
    {
        self::$route[$name] = array(
            'name' => $name,
            'uri' => $uri,
            'method' => $method,
            'params' => $params,
            'description' => $desc,
            'success' => ($successResponse instanceof Model) ? ($successResponse->jsonName.': '.$successResponse->toJson()) : $successResponse,
//            'success' => (($successResponse instanceof Model) ? ($successResponse->jsonName) : '').': '.$successResponse->toJson() ,
            'fail' => $failResponse
        );
    }

}

DocumentRoute::route('register', '/register', 'POST',
    // params
    [
        ['username', 'required', 'Tên đăng nhập'],
        ['email', 'required', 'Email xác thực tài khoản'],
        ['password', 'required', 'Mật khẩu đăng nhập'],
    ],
    // Description
    'Đăng ký thành viên',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40002, 'Thiếu param email'],
        [40003, 'Thiếu param password'],
        [40901, 'Username đã tồn tại'],
        [40902, 'Email đã tồn tại'],

    ]
);

DocumentRoute::route('login', '/login', 'POST',
    // params
    [
        ['username', 'required', 'Tên đăng nhập'],
        ['password', 'required', 'Mật khẩu đăng nhập'],
    ],
    // Description
    'Đăng nhập',
    // Sucess Response
    AccessToken::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40003, 'Thiếu param password'],
        [40101, 'Sai username hoặc password'],
        [40102, 'Account chưa được kích hoạt'],
    ]
);

DocumentRoute::route('logout', '/logout', 'GET',
        // params
        [
            ['token', 'required (query)', 'Mã xác thực tài khoản đã đăng nhập'],
        ],
        // Description
        'Đăng xuất - Chú ý: Logout sẽ xoá token',
        // Sucess Response
        'empty - chỉ trả về mã 200 và message',
        // Error Response
        [
            [40300, 'Sai mã xác thực'],
        ]
);


DocumentRoute::route('verify account', '/users/{id}/verify', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['code', 'required', 'Mã xác thực tài khoản được gửi vào email xác thực'],
    ],
    // Description
    'Kích hoạt tài khoản',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40004, 'Thiếu token param'],
        [40404, 'Sai user id'],
    ]
);

DocumentRoute::route('resend verify code', '/users/{id}/verify', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Gửi lại mã xác thực vào email xác thực',
    // Sucess Response
    VerifyStatus::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40903, 'Account đã được xác thực'],
    ]
);

DocumentRoute::route('forgot password', '/resend_password', 'GET',
    // params
    [
        ['username', 'required (query)', 'Tên đăng nhập'],
        ['email', 'required (query)', 'Email kiểm tra người dùng có đúng chủ sở hữu'],
    ],
    // Description
    'Gửi password mới vào email xác thục',
    // Sucess Response
    User::dumm(),
    // Error Response
    [
        [40001, 'Thiếu param username'],
        [40002, 'Thiếu param email'],
        [40401, 'Khôgn tìm thấy user'],
        [40402, 'Sai email'],
    ]
);

DocumentRoute::route('update password', '/update_password', 'POST',
    // params
    [
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['password', 'required', 'Password mới'],
    ],
    // Description
    'Cập nhật password mới của người dùng',
    // Sucess Response
    User::dumm(),
    // Error Response
    [
        [40003, 'Thiếu param password'],
        [40300, 'Sai mã xác thực'],
    ]
);

DocumentRoute::route('Get user profile', '/users/{id}/profile', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy thông tin cá nhân của người dùng theo id',
    // Sucess Response
    Profile::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);


DocumentRoute::route('Update user profile', '/users/{id}/profile', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required ', 'Mã xác thực tài khoản đã đăng nhập'],
        ['first_name', 'non-required', 'Tên'],
        ['last_name', 'non-required', 'Họ'],
        ['birth', 'non-required', 'Format yyyy-MM-dd'],
        ['gender', 'non-required', 'male, female, unknown'],
        ['profile_picture_id', 'non-required', 'male, female, unknown'],

    ],
    // Description
    'Cập nhật thông tin cá nhân của người dùng theo id',
    // Sucess Response
    Profile::dumm(),
    // Error Response
    [
        [40300, 'Sai mã xác thực'],
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image']
    ]
);


DocumentRoute::route('Get location', '/users/{id}/location', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy danh sách địa điểm của người dùng',
    // Sucess Response
    Location::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);

DocumentRoute::route('Create location', '/users/{id}/location', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['longitude', 'required', 'Kinh độ'],
        ['latitude', 'required', 'Vĩ độ'],
        ['city', 'non-required', 'Tên thành phố'],

    ],
    // Description
    'Thêm một địa điểm của người dùng',
    // Sucess Response
    Location::dummMany(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40005, 'Thiếu param longitude'],
        [40006, 'Thiếu param latitude'],

    ]
);

DocumentRoute::route('Get single location', '/users/{id}/location/{location_id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['location_id', 'required (query)', 'Location id']

    ],
    // Description
    'Lấy một location của người dùng theo id',
    // Sucess Response
    Location::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40405, 'Thiếu param location id'],
        [40905, 'Sai location id hoặc user id']
    ]
);

DocumentRoute::route('delete location', '/users/{id}/location/{location_id}', 'DELETE',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['location_id', 'required (query)', 'Location id']

    ],
    // Description
    'Xoá một địa điểm của người dùng theo id',
    // Sucess Response
    'empty - chỉ trả về mã 200 và message',
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40405, 'Thiếu param location id'],
        [40905, 'Sai location id hoặc user id']
    ]
);



DocumentRoute::route('Get image', '/users/{id}/image', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
    ],
    // Description
    'Lấy danh sách image của người dùng',
    // Sucess Response
    Image::dummMany(),
    // Error Response
    [
        [40404, 'Sai user id'],
    ]
);


DocumentRoute::route('Upload image', '/users/{id}/image', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['image_base64', 'required', 'Mã base64 của hình ảnh - Chú ý: phải có prefix: data:image/jpeg;base64,'],
        ['description', 'non-required', 'Miêu tả thông tin hình ảnh'],

    ],
    // Description
    'Upload một ảnh của người dùng (ảnh profile)',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40007, 'Thiếu param image_base64'],
    ]
);


DocumentRoute::route('Upload image', '/users/{id}/image', 'POST',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
        ['image_base64', 'required', 'Mã base64 của hình ảnh - Chú ý: phải có prefix: data:image/jpeg;base64,'],
        ['description', 'non-required', 'Miêu tả thông tin hình ảnh'],

    ],
    // Description
    'Upload một ảnh của người dùng (ảnh profile)',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40300, 'Sai mã xác thực'],
        [40007, 'Thiếu param image_base64'],
    ]
);


DocumentRoute::route('Get single image', '/users/{id}/image/{image_id}', 'GET',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id']
    ],
    // Description
    'Lấy thông tin ảnh theo id',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40906, 'Image và user không khớp']
    ]
);

DocumentRoute::route('update single image', '/users/{id}/image/{image_id}', 'PUT',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
    ],
    // Description
    'Update thông tin ảnh theo id',
    // Sucess Response
    Image::dumm(),
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40300, 'Sai mã xác thực'],
        [40906, 'Image và user không khớp']
    ]
);


DocumentRoute::route('delete image', '/users/{id}/image/{image_id}', 'DELETE',
    // params
    [
        ['id', 'required (query)', 'User id'],
        ['image_id', 'required (query)', 'Image id'],
        ['token', 'required', 'Mã xác thực tài khoản đã đăng nhập'],
    ],
    // Description
    'delete ảnh theo id',
    // Sucess Response
    'empty - chỉ trả về mã 200 và message',
    // Error Response
    [
        [40404, 'Sai user id'],
        [40406, 'Không tìm thấy image'],
        [40300, 'Sai mã xác thực'],
        [40906, 'Image và user không khớp']
    ]
);