<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ServiceFaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('service_faqs')->delete();
        
        \DB::table('service_faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'service_id' => 6,
                'question' => '{"en":"What is a lawyer directory?"}',
                'answer' => '{"en":"A lawyer directory is an online or printed resource that lists lawyers, law firms, and legal professionals. These directories typically include contact information, areas of practice, credentials, and sometimes client reviews and ratings."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-14 13:55:08',
                'updated_at' => '2024-05-14 13:55:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'service_id' => 7,
                'question' => '{"en":"What are paralegal services?"}',
                'answer' => '{"en":"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-14 13:57:44',
                'updated_at' => '2024-05-14 13:58:41',
                'deleted_at' => '2024-05-14 13:58:41',
            ),
            2 => 
            array (
                'id' => 3,
                'service_id' => 7,
                'question' => '{"en":"What are paralegal services?"}',
                'answer' => '{"en":"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-14 13:58:41',
                'updated_at' => '2024-05-14 13:58:41',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'service_id' => 8,
                'question' => '{"en":"What are court filings?"}',
                'answer' => '{"en":"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-14 14:00:58',
                'updated_at' => '2024-05-16 11:51:57',
                'deleted_at' => '2024-05-16 11:51:57',
            ),
            4 => 
            array (
                'id' => 5,
                'service_id' => 8,
                'question' => '{"en":"What are court filings?"}',
                'answer' => '{"en":"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-16 11:51:57',
                'updated_at' => '2024-05-16 11:51:57',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'service_id' => 8,
                'question' => '{"en":"Do I have to pay a fee to file documents with the court?"}',
                'answer' => '{"en":"Yes, in many jurisdictions, filing documents with the court requires payment of a filing fee. The amount depends on the type of document and the court\'s fee schedule. Some parties may qualify for fee waivers based on financial hardship."}',
                'is_active' => 1,
                'sort_order' => NULL,
                'image' => NULL,
                'created_at' => '2024-05-16 11:51:57',
                'updated_at' => '2024-05-16 11:51:57',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}