<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="main-url" content="{{ url('/') }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        #loading {
            position: fixed;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            position: absolute;
            top: 100px;
            left: 240px;
            z-index: 100;
        }
    </style>
</head>
<body>
    <div id="loading">
        <img id="loading-image" src="https://res.cloudinary.com/practicaldev/image/fetch/s--QHuL8Cy7--/c_imagga_scale,f_auto,fl_progressive,h_420,q_66,w_1000/https://dev-to-uploads.s3.amazonaws.com/i/cmidlcq1jvb4o8gg76a6.gif" alt="Loading..." />
      </div>
      <div class="d-none" id="sampleTablerow">
          <tr>
              <th scope="row"></th>
              <td></td>
              <td>
                <select id="itemSelection">
                    <option disabled selected>pilih item</option>
                    @foreach (\DB::table('items')->limit(10)->get() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>   
              </td>
              <td>
                  <input type="number" name="qty[]" class="form-control">
              </td>
              <td style="text-align: center"><a href="javascript:void(0)" onclick="removeRow(event)" class="btn btn-danger btn-sm">batal</a></td>
          </tr>          
      </div>
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('logout') }}" class="btn btn-danger float-right">Logout</a>
                    <h3>Dashboard</h3>
                </div>
                <div class="card-body">
                    <h5>Selamat datang di halaman dashboard, <strong>{{ Auth::user()->name }}</strong></h5>
                    <span>berikut list penjualan kamu :)</span>
                    <div class="mt-3">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">no. Inv</th>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col" style="width: 15%;text-align:center"><a href="javascript:void(0)" onclick="addTransaction(event)" class="btn btn-success">+</a></th>
                              </tr>
                            </thead>
                            <tbody id="tbody">
                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/transaction.js') }}"></script>
</body>
</html>
