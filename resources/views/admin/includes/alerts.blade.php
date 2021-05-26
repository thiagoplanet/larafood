                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error )
                        <p>{{ $error }}</p>
                    @endforeach
                </div>

                @endif

                @if (session('message'))
                    <div class="alert alert-warning">
                        Mensagem: {{ session('message') }}
                    </div>
                @endif

                 @if (session('error'))
                    <div class="alert alert-danger">
                        Mensagem: {{ session('error') }}
                    </div>
                @endif
