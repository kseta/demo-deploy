# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  boxes = {
    "deploy" => {
      "ip" => "192.168.50.10",
      "port-host" => "2210"
    },
    "test1" => {
      "ip" => "192.168.50.21",
      "port-host" => "2221"
    },
    "staging" => {
      "ip" => "192.168.50.30",
      "port-host" => "2230"
    },
    "production1" => {
      "ip" => "192.168.50.41",
      "port-host" => "2241"
    },
    "production2" => {
      "ip" => "192.168.50.42",
      "port-host" => "2242"
    }
  }

  boxes.each{|name, values|
    config.vm.define name do |box|
      # Box settings
      box.vm.hostname = name
      box.vm.box = "ubuntu/xenial64"

      # Network settings
      box.vm.network :private_network, ip: values["ip"]
      box.vm.network "forwarded_port", guest: 22, host: values["port-host"], id: "ssh"

      # Shared directory settings
      box.vm.synced_folder ".", "/vagrant", disabled: true
    end
  }
end
