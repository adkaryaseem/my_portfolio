<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Certification;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin User
        User::factory()->create([
            'name' => 'Ashim Adhikari',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Insert Settings
        $settings = [
            'hero_name' => 'Ashim Adhikari',
            'hero_title' => 'Cybersecurity & Network Engineer',
            'about_me' => 'I\'m Ashim Adhikari — a passionate Cybersecurity practitioner and Network Engineer. I specialize in designing secure digital infrastructures, analyzing vulnerabilities, and maintaining resilient enterprise networks. My focus is on building tech that performs reliably and protects against modern threats.',
            'about_subtitle' => 'Level 3 Certified Professional Computer Hardware and Network Technician (CTEVT-NSTB) with extensive experience in system administration, penetration testing, and IT infrastructure management.',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
            'twitter_url' => 'https://twitter.com',
            'contact_email' => 'info@ashimadhikari.info.np',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        // 3. Insert Skills
        $skills = [
            'Cyber Security', 'Network Administration', 'Hardware Troubleshooting', 'Penetration Testing', 
            'Server Configuration', 'Windows Server', 'Linux System Admin', 'Active Directory', 'DNS/DHCP',
            'Firewall Configuration', 'Vulnerability Assessment', 'Virtualization (VMware/Proxmox)', 'Data Recovery',
            'Python (Scripting)', 'Bash Scripting', 'Cisco Routing & Switching'
        ];

        foreach ($skills as $skill) {
            Skill::create([
                'name' => $skill,
                'category' => 'Engineering & Security',
                'proficiency' => 85 + rand(0, 10) // Random proficiency between 85 and 95
            ]);
        }

        // 4. Insert Projects
        Project::create([
            'title' => 'Enterprise Network Simulation',
            'description' => 'Designed and simulated a highly secure enterprise network architecture using Cisco Packet Tracer and GNS3, implementing VLANs, OSPF, and strict firewall policies.',
            'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=600&auto=format&fit=crop',
            'url' => '#'
        ]);
        Project::create([
            'title' => 'Vulnerability Assessment Lab',
            'description' => 'Built an isolated virtual environment to deploy vulnerable machines, actively performing penetration tests and documenting security flaws to propose mitigation strategies.',
            'image_url' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=600&auto=format&fit=crop',
            'url' => '#'
        ]);
        Project::create([
            'title' => 'Automated Server Backup System',
            'description' => 'Developed custom Bash and Python scripts to automate routine server backups across Linux nodes, ensuring data integrity and rapid recovery protocols.',
            'image_url' => 'https://images.unsplash.com/photo-1597852074816-d933c7d2b988?q=80&w=600&auto=format&fit=crop',
            'url' => '#'
        ]);

        // 5. Insert Experience
        Experience::create([
            'title' => 'Lab Instructor',
            'company' => 'System Bull Information and Communication Technology College',
            'start_date' => 'June 2021',
            'end_date' => 'Present',
            'description' => 'Teaching computer hardware and network courses, guiding students in practical labs, configuring servers, and demonstrating real-world cybersecurity practices.'
        ]);
        Experience::create([
            'title' => 'IT Infrastructure Specialist',
            'company' => 'System Bull ICT College',
            'start_date' => '2021',
            'end_date' => 'Present',
            'description' => 'Built and maintained the entire IT Infrastructure, including Windows/Linux server setups, active directory implementation, and hardware maintenance.'
        ]);
        Experience::create([
            'title' => 'Freelance Network & Security Consultant',
            'company' => 'Self Employed',
            'start_date' => '2022',
            'end_date' => 'Present',
            'description' => 'Providing hardware troubleshooting, network installations, and security audits for local businesses to ensure operational resilience.'
        ]);

        // 6. Insert Certifications
        $certs = [
            'CTEVT-NSTB Level 3 Certified Professional Computer Hardware and Network Technician',
            'Cyber Security Fundamentals',
            'Computer Hardware & Architecture',
            'Enterprise Networking and Servers',
            'Cisco Routing and Switching',
            'Windows Server Management',
            'Linux System Administration',
            'Internet & Network Safety'
        ];

        foreach ($certs as $cert) {
            Certification::create([
                'name' => $cert,
                'issuer' => 'Various Technical Boards',
                'date' => '2024'
            ]);
        }
    }
}
