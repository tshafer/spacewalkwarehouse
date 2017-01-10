<!DOCTYPE html>
<html style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Request From Inflatable Zoo</title>
</head>
<body bgcolor="#f6f6f6" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6"
       style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">
	<tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
		<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
		<td class="container" bgcolor="#FFFFFF" style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">

			<!-- content -->
			<div class="content"
			     style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
				<table style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;">
					<tr style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
						<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
							<h1 style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 18px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">Request from Inflatable Zoo Warehouse:</h1>
							<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6em; font-weight: normal; margin: 0 0 10px; padding: 0;">
							<p>First Name: {{$data['first_name']}}</p>
							<p>Last Name: {{$data['last_name']}}</p>
							<p>Branch Name: {{$data['branch_name']}}</p>
							<p>Reason for Request: {{$data['message']}}</p>

							<table style="width:100%; border:1px solid #ccc;border-spacing: 0px;">
								<thead style="background: #ccc;font-weight: bold;">
								<tr>
									<td>Product</td>
									<td>Grade</td>
								</tr>
								</thead>
								<tbody>
								@foreach($cart as $unit)
									<tr style="border:1px solid #ccc">
										<td>
											<div>
												@if($unit->options->image)
													<a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
														<img src="{{getenv('APP_URL')}}/{{$unit->options->image}}" alt="{{$unit->options->product_name}}" title="{{$unit->options->product_name}}" width="47" height="47"/>
													</a>
												@endif
												<a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a><br/>
													- ({{$unit->options->width}} x {{$unit->options->length}}
													x {{$unit->options->height}}) @if($unit->options->weight) - ({{$unit->options->weight}} LBS) @endif
											</div>

										</td>
										<td>{{$unit->options->grade}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
	</tr>
</table>

</body>
</html>