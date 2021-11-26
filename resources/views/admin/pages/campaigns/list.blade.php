<table class="table table-bordered">
    <thead>
    <tr class="thead--row">
        <th scope="col" class="font-weight-bold">#</th>
        <th scope="col" class="font-weight-bold">Chủ đề</th>
        <th scope="col" class="font-weight-bold">Gửi đến</th>
        <th scope="col" class="font-weight-bold">Nội dung</th>
        <th scope="col" data-sort-by="created_at"
            class="font-weight-bold sorting {{request()->get('sort_by') === 'created_at' ? 'sorting--'.request()->get('order_by') : ''}}">
            Thời gian gửi
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse ($campaigns as $campaign)
        <tr>
            <td scope="row">{{($campaigns->currentPage() - 1) * $campaigns->perPage() + $loop->iteration}}</td>
            <td>{{$campaign->subject}}</td>
            <td class="text-truncate" style="max-width: 20rem;">{{implode('; ', json_decode($campaign->to, true))}}</td>
            <td>{!! $campaign->body !!}</td>
            <td>{{date('d/m/Y H:i:s', strtotime($campaign['created_at']))}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center font-weight-bold py-5">Không có dữ liệu!</td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="row mx-0 mt-2">
    <div class="col-md-6">
        Hiển thị {{$campaigns->total() > ($campaigns->currentPage() - 1) * $campaigns->perPage() ? ($campaigns->currentPage() - 1) * $campaigns->perPage() + 1 : 0}} đến
        {{$campaigns->total() < ($campaigns->currentPage() - 1) * $campaigns->perPage() + $campaigns->perPage() ? $campaigns->total() : ($campaigns->currentPage() - 1) * $campaigns->perPage() + $campaigns->perPage()}}
        của
        {{$campaigns->total()}} bản ghi
    </div>
    <div class="col-md-6">
        {{$campaigns->links('vendor.pagination.bootstrap-4')}}
    </div>
</div>
