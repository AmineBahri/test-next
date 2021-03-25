<ul class="list-group mb-3">
	<a href="{{route('home')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Dashboard') }}
	</a>
	<a href="{{route('regions.index')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Regions') }}
	</a>
	<a href="{{route('municipalites.index')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Municipalites') }}
	</a>
	<a href="{{route('companies.index')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Companies') }}
	</a>
	<a href="{{route('customerstype.index')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Customers Type') }}
	</a>
	<a href="{{url('customers')}}" class="list-group-item font-weight-bold list-group-item-action">
		{{ __('messages.Customers') }}
	</a>
</ul>