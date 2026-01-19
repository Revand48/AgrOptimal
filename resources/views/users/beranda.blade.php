@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

    <x-section_beranda.hero />
    <x-section_beranda.data :homeData="$homeData" />
    <x-section_beranda.mengapa />
    <x-section_beranda.layanan />
    <x-section_beranda.faq :homeFaqs="$homeFaqs" />
    <x-section_beranda.pengaduan />


@endsection
