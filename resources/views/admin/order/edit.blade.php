<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование заказа</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="customer_name">Имя клиента</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
                            @error('customer_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_email">Email клиента</label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', $order->customer_email) }}" required>
                            @error('customer_email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Статус заказа</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                    <form method="post" action="{{route('public.order.cancel', $order->id)}}">
                        @csrf
                        <button class="btn btn" type="submit">Cancel order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
